# WordPress Plugin Release Workflow

This document explains how to use the GitHub Actions workflow to create a WordPress plugin release.

## Overview

The `create-plugin-release.yml` workflow automates the process of creating a WordPress plugin release. It packages the plugin files, creates a versioned ZIP file, and publishes a GitHub release with the plugin package attached.

## How to Use

### Prerequisites

- Repository must be on GitHub
- You must have write access to the repository
- GitHub Actions must be enabled for the repository

### Creating a Release

1. **Navigate to Actions Tab**
   - Go to your GitHub repository
   - Click on the "Actions" tab

2. **Select the Workflow**
   - Find "Create WordPress Plugin Release" in the workflow list
   - Click on it

3. **Run Workflow**
   - Click the "Run workflow" button (on the right side)
   - Fill in the required inputs:
     - **version**: The release version in X.Y.Z format (e.g., `2.0.4`)
     - **release_name**: (Optional) A custom name for the release (defaults to "Version X.Y.Z")
     - **prerelease**: (Optional) Check this box if creating a pre-release/beta version
   - Click "Run workflow" button to start

4. **Monitor Progress**
   - The workflow will run and show progress in real-time
   - You can click on the running workflow to see detailed logs

5. **Download Release**
   - Once complete, go to the "Releases" section of your repository
   - Find the newly created release (tagged as `vX.Y.Z`)
   - Download the `ultimate-manga-scraper-X.Y.Z.zip` file

## What the Workflow Does

The workflow performs the following steps:

1. **Validates Version Format**: Ensures the version follows semantic versioning (X.Y.Z format)

2. **Updates Plugin Version**: Automatically updates the version number in `ultimate-manga-scraper.php`

3. **Creates Plugin Package**: 
   - Copies all necessary plugin files
   - Excludes development files (.git, .github, node_modules, etc.)
   - Creates a ZIP file named `ultimate-manga-scraper-X.Y.Z.zip`

4. **Generates Changelog**: Reads the CHANGELOG.md file (if exists) for release notes

5. **Creates GitHub Release**:
   - Creates a new release with tag `vX.Y.Z`
   - Attaches the plugin ZIP file
   - Includes installation instructions and requirements
   - Adds changelog content to release notes

6. **Provides Summary**: Shows a summary of the created release

## Installing the Plugin

To install the released plugin on a WordPress site:

1. Download the `ultimate-manga-scraper-X.Y.Z.zip` file from the GitHub release
2. Log in to your WordPress Admin Dashboard
3. Go to **Plugins → Add New → Upload Plugin**
4. Choose the downloaded ZIP file
5. Click "Install Now"
6. Click "Activate Plugin"

## Files Excluded from Release

The following files and directories are automatically excluded from the plugin package:

- `.git` - Git repository data
- `.github` - GitHub configuration files
- `node_modules` - Node.js dependencies
- `.gitignore`, `.gitattributes` - Git configuration files
- `*.log` - Log files
- `*.tmp` - Temporary files
- `.DS_Store` - macOS system files
- `Thumbs.db` - Windows system files

## Requirements

The plugin requires:

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Madara theme (required)
- Madara Core plugin (required)

## Troubleshooting

### Workflow Fails on Version Validation

- Ensure version is in X.Y.Z format (e.g., 2.0.4)
- Don't include 'v' prefix in the version input
- Use only numbers separated by dots

### Release Already Exists

- Delete the existing release and tag from GitHub
- Or use a different version number

### Permission Denied

- Ensure you have write access to the repository
- Check that GitHub Actions has necessary permissions

## Support

For issues or questions:

- Open an issue on the [GitHub repository](https://github.com/druvx13/ultimate-manga-scraper)
- Check existing documentation in the repository
