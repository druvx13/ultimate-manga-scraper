# Performance Tuning Guide

## Overview

This guide provides detailed recommendations for optimizing the performance of the **Ultimate Web Novel & Manga Scraper** plugin. Whether you're running a small personal site or a high-traffic manga aggregation platform, these tips will help you maximize efficiency and minimize resource usage.

## Table of Contents

1. [Server Optimization](#server-optimization)
2. [WordPress Optimization](#wordpress-optimization)
3. [Plugin Settings Optimization](#plugin-settings-optimization)
4. [Database Optimization](#database-optimization)
5. [Network & Scraping Optimization](#network--scraping-optimization)
6. [Storage Optimization](#storage-optimization)
7. [Monitoring & Profiling](#monitoring--profiling)

## Server Optimization

### Hardware Requirements

**Minimum (Testing):**
- 1 CPU core
- 1GB RAM
- 10GB storage
- Shared hosting

**Recommended (Production - Small):**
- 2 CPU cores
- 2GB RAM
- 50GB SSD storage
- VPS or dedicated server

**Recommended (Production - Large):**
- 4+ CPU cores
- 4GB+ RAM
- 200GB+ SSD storage
- Dedicated server or cloud instance

### PHP Configuration

Edit `php.ini` (or use `.htaccess` / `wp-config.php`):

```ini
; Memory and execution
memory_limit = 256M                ; Increase for large imports
max_execution_time = 300           ; Allow long-running scripts
max_input_time = 300               ; Allow slow network operations

; File uploads (for images)
upload_max_filesize = 20M
post_max_size = 25M

; Performance
opcache.enable = 1                 ; Enable OPcache
opcache.memory_consumption = 128   ; OPcache memory
opcache.interned_strings_buffer = 8
opcache.max_accelerated_files = 10000
opcache.validate_timestamps = 0    ; Disable in production
```

**Applying changes:**
```bash
# Restart PHP-FPM
sudo systemctl restart php7.4-fpm

# Or restart Apache
sudo systemctl restart apache2
```

### Web Server Configuration

#### Nginx

```nginx
# /etc/nginx/sites-available/yoursite

server {
    # Increase timeouts for long scraping operations
    fastcgi_read_timeout 300;
    fastcgi_send_timeout 300;
    
    # Increase buffer sizes
    fastcgi_buffer_size 32k;
    fastcgi_buffers 8 32k;
    
    # Cache static assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
    
    # Protect log files
    location ~ \.log$ {
        deny all;
    }
}
```

#### Apache

```apache
# .htaccess or httpd.conf

# Increase timeouts
Timeout 300
ProxyTimeout 300

# Enable compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>

# Cache static assets
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpeg "access plus 30 days"
    ExpiresByType image/png "access plus 30 days"
    ExpiresByType text/css "access plus 7 days"
    ExpiresByType application/javascript "access plus 7 days"
</IfModule>

# Protect log files
<FilesMatch "\.log$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

### Operating System Tuning

**Linux file limits:**

```bash
# /etc/security/limits.conf
www-data soft nofile 10000
www-data hard nofile 10000
```

**Apply immediately:**
```bash
sudo sysctl -w fs.file-max=100000
```

## WordPress Optimization

### Object Caching

Install and configure object caching for significant performance gains:

#### Redis (Recommended)

```bash
# Install Redis
sudo apt install redis-server

# Install PHP Redis extension
sudo apt install php-redis

# Restart services
sudo systemctl restart redis-server
sudo systemctl restart php7.4-fpm
```

Install WordPress Redis plugin:
```bash
wp plugin install redis-cache --activate
wp redis enable
```

#### Memcached (Alternative)

```bash
# Install Memcached
sudo apt install memcached php-memcached

# Restart services
sudo systemctl restart memcached
sudo systemctl restart php7.4-fpm
```

Install WordPress Memcached plugin:
```bash
wp plugin install memcached --activate
```

### WordPress Configuration

Edit `wp-config.php`:

```php
// Increase memory limit
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// Disable post revisions (saves DB space)
define('WP_POST_REVISIONS', 5);
define('AUTOSAVE_INTERVAL', 300); // 5 minutes

// Enable debugging only in development
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Use real cron instead of WP-Cron
define('DISABLE_WP_CRON', true);

// Enable object cache
define('WP_CACHE', true);

// Compress files
define('COMPRESS_CSS', true);
define('COMPRESS_SCRIPTS', true);
define('CONCATENATE_SCRIPTS', true);
define('ENFORCE_GZIP', true);
```

### Database Query Optimization

Install **Query Monitor** plugin to identify slow queries:

```bash
wp plugin install query-monitor --activate
```

Review the slowest queries and optimize them.

## Plugin Settings Optimization

### Main Settings

**For High Performance:**

```
Main Switch: ON
Enable Logging: ON (only in testing/debugging)
Enable Detailed Logging: OFF (use only when troubleshooting)
Auto Clear Logs: Daily (prevent log file from growing)

Request Timeout: 2-3 seconds (balance between speed and reliability)
Rule Timeout: 120 seconds (prevent runaway processes)

Max Chapters per Run: 10-20 (reduce for faster execution)
```

### Scraping Strategy

**Choose the right method:**

1. **cURL** (fastest): Use for static HTML sites
2. **PhantomJS** (medium): Use only when JavaScript is required
3. **Puppeteer** (slowest but most reliable): Use for complex JS or Cloudflare
4. **HeadlessBrowserAPI**: Use as last resort (costs money)

**Recommendation**: Start with cURL, upgrade only if needed.

### Translation Settings

**Performance impact:**

- **Disabled**: Fastest (no translation)
- **Google API**: Fast (parallel requests possible)
- **DeepL API**: Fast
- **Microsoft API**: Fast
- **Google Free**: Slowest (scraping, rate limited)

**Recommendation**: Use API services, not free scraping.

### Storage Settings

**Performance comparison:**

1. **Local**: Fastest (no network latency)
2. **Amazon S3**: Medium (network upload)
3. **Imgur**: Slow (API rate limits)
4. **Flickr**: Slow (API rate limits)

**Recommendation**: Use local for best performance, S3 for scalability.

## Database Optimization

### Regular Maintenance

**Weekly tasks:**

```bash
# Optimize tables
wp db optimize

# Repair tables (if needed)
wp db repair

# Clean up
wp transient delete --all
wp post delete $(wp post list --post_status=trash --format=ids) --force
```

**Monthly tasks:**

```bash
# Full database optimization
mysqlcheck -u root -p --auto-repair --optimize --all-databases

# Remove old revisions
wp post delete $(wp post list --post_type=revision --format=ids) --force
```

### Indexing

Add custom indexes for frequently queried meta:

```sql
-- Speed up manga lookups by import slug
ALTER TABLE wp_postmeta 
ADD INDEX idx_manga_import_slug (meta_key, meta_value(191));

-- Speed up chapter queries
ALTER TABLE wp_postmeta 
ADD INDEX idx_chapter_index (meta_key, meta_value(50));
```

### Database Caching

Use MySQL/MariaDB query cache:

```ini
; /etc/mysql/my.cnf or /etc/mysql/mariadb.conf.d/50-server.cnf

[mysqld]
query_cache_type = 1
query_cache_size = 128M
query_cache_limit = 2M

# InnoDB settings
innodb_buffer_pool_size = 1G
innodb_log_file_size = 256M
innodb_flush_log_at_trx_commit = 2
innodb_flush_method = O_DIRECT
```

Restart MySQL:
```bash
sudo systemctl restart mysql
```

## Network & Scraping Optimization

### Connection Pooling

Reuse HTTP connections when scraping multiple chapters:

```php
// In plugin code (advanced)
$ch = curl_init();
curl_setopt($ch, CURLOPT_FORBID_REUSE, false);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);
```

### Parallel Downloads

For multiple images, consider parallel downloads:

```bash
# Using GNU Parallel (advanced - requires code modification)
cat image_urls.txt | parallel -j 4 wget {}
```

### DNS Caching

Install local DNS cache:

```bash
sudo apt install dnsmasq
```

Configure to cache DNS for 24 hours.

### Proxy Rotation

Use proxy rotation for better performance and avoiding bans:

**Setup:**
1. Get a pool of proxies (residential preferred)
2. Configure in plugin: `proxy1:8080,proxy2:8080,proxy3:8080`
3. Plugin automatically rotates through list

**Tip**: Use datacenter proxies for speed, residential for reliability.

## Storage Optimization

### Image Optimization

**Install ImageMagick:**

```bash
sudo apt install imagemagick php-imagick
```

**Optimize images on upload:**

```bash
# Create a script to optimize existing images
find wp-content/uploads/manga -name "*.jpg" -exec jpegoptim --max=85 {} \;
find wp-content/uploads/manga -name "*.png" -exec optipng -o2 {} \;
```

**Add to crontab for automatic optimization:**

```bash
0 2 * * * find /path/to/wp-content/uploads/manga -name "*.jpg" -mtime -1 -exec jpegoptim --max=85 {} \;
```

### WebP Conversion

Convert images to WebP for better compression:

```bash
# Install WebP tools
sudo apt install webp

# Convert script
for file in *.jpg; do
    cwebp -q 80 "$file" -o "${file%.jpg}.webp"
done
```

### CDN Integration

**CloudFlare (Free):**

1. Add your site to CloudFlare
2. Configure DNS
3. Enable "Auto Minify" and "Polish"
4. Set browser cache TTL to 1 month

**Amazon CloudFront:**

1. Create CloudFront distribution
2. Point origin to your S3 bucket or domain
3. Configure cache behaviors
4. Update Madara settings to use CloudFront URLs

### Filesystem Optimization

**Use SSD:** Manga sites are I/O intensive. SSD provides 10-100x improvement.

**Mount options** for manga storage:

```bash
# /etc/fstab
/dev/sda1 /var/www/html ext4 noatime,nodiratime 0 0
```

This reduces write operations.

## Monitoring & Profiling

### Server Monitoring

**Install monitoring tools:**

```bash
# htop for process monitoring
sudo apt install htop

# iotop for I/O monitoring
sudo apt install iotop

# nethogs for network monitoring
sudo apt install nethogs
```

**Monitor during scraping:**

```bash
# CPU and RAM
htop

# Disk I/O
sudo iotop

# Network usage
sudo nethogs
```

### Application Performance Monitoring

**Install and configure New Relic (optional):**

1. Sign up at newrelic.com
2. Install PHP agent
3. Monitor performance metrics
4. Identify bottlenecks

**Or use Query Monitor plugin** (free):

```bash
wp plugin install query-monitor --activate
```

### Log Analysis

**Analyze plugin logs:**

```bash
# Count errors
grep "ERROR" wp-content/ums_info.log | wc -l

# Find slow operations
grep "took.*seconds" wp-content/ums_info.log | sort -t: -k2 -n

# Most common errors
grep "ERROR" wp-content/ums_info.log | cut -d] -f3 | sort | uniq -c | sort -rn | head -10
```

### Performance Benchmarking

**Test scraping speed:**

```bash
# Time a single rule execution
time wp eval 'ums_run_rule(5, "manga");'

# Benchmark database queries
wp db query "SHOW PROFILES;" --allow-root
```

**Monitor page load times:**

```bash
# Install and use Apache Bench
ab -n 100 -c 10 https://yoursite.com/manga/one-piece/
```

## Cron Optimization

### System Cron Setup

**Optimal configuration:**

```bash
# /etc/crontab

# Run WP-Cron every minute
* * * * * www-data cd /var/www/html && wp cron event run --due-now --quiet

# Or using wget
* * * * * www-data wget -q -O - https://yoursite.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
```

### Stagger Rule Execution

**Avoid running all rules at once:**

Instead of:
- Rule 1: Every 24 hours at 00:00
- Rule 2: Every 24 hours at 00:00
- Rule 3: Every 24 hours at 00:00

Use:
- Rule 1: Every 24 hours (starting at 00:00)
- Rule 2: Every 24 hours (starting at 08:00)
- Rule 3: Every 24 hours (starting at 16:00)

This spreads the load throughout the day.

### Cron Locking

The plugin uses file locking to prevent concurrent execution. Ensure:

```bash
# Permissions on plugin directory
sudo chown -R www-data:www-data /var/www/html/wp-content/plugins/ultimate-manga-scraper
sudo chmod -R 755 /var/www/html/wp-content/plugins/ultimate-manga-scraper
```

## Scaling Strategies

### Horizontal Scaling

**For very large operations:**

1. **Separate scraping server**: Run scraper on dedicated server, sync to production
2. **Load balancer**: Distribute web traffic across multiple frontend servers
3. **Database replication**: Master for writes, slaves for reads

### Vertical Scaling

**When to upgrade:**

- CPU usage consistently >80%
- RAM usage consistently >80%
- Disk I/O wait >10%
- Network bandwidth saturated

**Upgrade path:**
1. Start: 1 core, 1GB RAM
2. Small site: 2 cores, 2GB RAM
3. Medium site: 4 cores, 4GB RAM
4. Large site: 8+ cores, 8GB+ RAM

## Best Practices Summary

### Do's

✓ Use system cron instead of WP-Cron
✓ Enable object caching (Redis/Memcached)
✓ Use SSD storage for database and uploads
✓ Optimize images before storage
✓ Use CDN for serving images
✓ Monitor server resources regularly
✓ Keep WordPress and plugins updated
✓ Regular database optimization
✓ Stagger scraping schedules
✓ Use appropriate scraping method (cURL vs headless)

### Don'ts

✗ Don't run all rules simultaneously
✗ Don't use detailed logging in production
✗ Don't use free translation services for high volume
✗ Don't scrape more than needed
✗ Don't ignore log warnings
✗ Don't use shared hosting for production
✗ Don't store excessive post revisions
✗ Don't skip regular backups
✗ Don't use headless browsers unnecessarily
✗ Don't set request timeout too low (causes failures)

## Troubleshooting Performance Issues

### High CPU Usage

**Causes:**
- Headless browsers (PhantomJS/Puppeteer)
- Too many concurrent scraping operations
- Poor database indexing

**Solutions:**
- Limit use of headless browsers
- Stagger scraping schedules
- Add database indexes
- Upgrade CPU

### High Memory Usage

**Causes:**
- Large images in memory
- PHP memory leaks
- Too many simultaneous processes

**Solutions:**
- Increase `memory_limit`
- Process images in batches
- Restart PHP-FPM regularly
- Upgrade RAM

### Slow Database Queries

**Causes:**
- Missing indexes
- Large tables without optimization
- No query caching

**Solutions:**
- Add indexes (see Database Optimization)
- Regular OPTIMIZE TABLE
- Enable query cache
- Consider database replication

### Network Bottlenecks

**Causes:**
- Slow source sites
- Bandwidth limitations
- Too many simultaneous connections

**Solutions:**
- Use faster proxies
- Limit concurrent downloads
- Upgrade network bandwidth
- Use CDN for serving

## Conclusion

Performance tuning is an ongoing process. Start with the basics (caching, cron, storage) and progressively optimize based on your specific bottlenecks. Monitor regularly and adjust as your site grows.

**Quick Wins:**
1. Enable object caching (Redis)
2. Use system cron
3. Optimize images
4. Use SSD storage
5. Configure OPcache

These five changes alone can improve performance by 5-10x for most installations.
