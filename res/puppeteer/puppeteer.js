/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
"use strict";
const puppeteer = require('puppeteer');
(async () => {
  var args = process.argv.slice(2);
  process.on('unhandledRejection', up => { throw up })
  var argarr = ['--no-sandbox', '--disable-setuid-sandbox'];
  var auth_user = '';
  var auth_pass = '';
  if(args[1] !== undefined && args[1] !== 'null')
  {
    const proxarr = args[1].split("~~~");
    if(proxarr[1] !== undefined)
    {
      const userpass = proxarr[1].split(":");
      if(userpass[1] !== undefined)
      {
          auth_user = userpass[0];
          auth_pass = userpass[1];
      }
      argarr.push("--proxy-server=" + proxarr[0]);
    }
    else
    {
      argarr.push("--proxy-server=" + args[1]);
    }
  }
  if(args[2] != 'default')
  {
      argarr.push("--user-agent=" + args[2]);
  }
  const browser = await puppeteer.launch({ignoreHTTPSErrors:true, args: argarr});
  const page = (await browser.pages())[0];
  if(auth_pass != '')
  {
    await page.authenticate({        
        username: auth_user,
        password: auth_pass
    });
  }
  if(args[3] != 'default')
  {
    var kkarr = args[3].split(';');
    kkarr.forEach(async function (value) 
    {
      var cookiesobje = '';
      var splitCookie = value.split('=');
      if(splitCookie[1] !== undefined)
      {
        try {
            cookiesobje += '{"name": "' + splitCookie[0].trim() + '","value": "' + decodeURIComponent(splitCookie[1]) + '", "url": "' + args[0] + '"}';
        } catch (error) {
            cookiesobje += '{"name": "' + splitCookie[0].trim() + '","value": "' + splitCookie[1] + '", "url": "' + args[0] + '"}';
        }
        if(cookiesobje != '')
        {
            try 
            {
                var cookiesobjex = JSON.parse(cookiesobje);
                await page.setCookie(cookiesobjex);
            }
            catch(error) 
            {
            }
        }
      }
    });
  }
  if(args[4] != 'default')
  {
      var xres = args[4].split(":");
      if(xres[1] != undefined)
      {
          var user = xres[0];
          var pass = xres[1];
          const auth = new Buffer(`${user}:${pass}`).toString('base64');
          await page.setExtraHTTPHeaders({
              'Authorization': `Basic ${auth}`                    
          });
      }
  }
  const isImage = await page.evaluate((url) => {
    const imageExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.bmp', '.jpe', '.webp'];
    var lowercasedUrl = url.toLowerCase();
    lowercasedUrl = lowercasedUrl.split('?')[0].split('#')[0];
    return imageExtensions.some((extension) => lowercasedUrl.endsWith(extension));
  }, args[0]);

  await page.goto(args[0], {waitUntil: 'networkidle2'});
  
  if (!isImage) 
  {
      const bodyWidth = await page.evaluate(() => document.body.scrollWidth);
      const bodyHeight = await page.evaluate(() => document.body.scrollHeight);
      await page.setViewport({ width: bodyWidth, height: bodyHeight });
      let bodyHTML = await page.content();
      console.log(bodyHTML);
  }
  else
  {
    const imageData = await page.evaluate(async () => {
      const response = await fetch(window.location.href);
      const blob = await response.blob();
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => resolve(reader.result);
        reader.onerror = reject;
        reader.readAsDataURL(blob);
      });
    });
    const base64Data = imageData.split(',')[1];
    console.log(base64Data);
  }
  await browser.close();
})();