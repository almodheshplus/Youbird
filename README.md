## About Youbird

Hello :wave:, Thank You for Using Youbird :dizzy:. **You Don't Have It?** Buy It Now From [Khamsat](https://khamsat.com/user/almodhesh_plus200) OR [Codecanyon](https://codecanyon.net/user/almodheshplus)

Youbird is a Youtube video Downloader.

Help Us Improving Youbird by Adding any problem you had in Issues Section, [Add Issue](https://github.com/almodheshplus/YoubirdHelp/issues/new/choose)

## Table Of Contents

1. [Features](#features)
2. [How To Install](#how-to-install)
    - [Edit menu links](#edit-menu-links)
3. [Advertisement Units](#advertisement-units)
4. [Edit Website Informations after installing](#edit-website-informations-after-installing)
5. [Add Code in head Tag](#add-code-in-head-tag)
6. [Create My Own Palette](#create-your-own-palette)
7. [Free Support](#free-support)
---

## Features

1. Support Downloding Videos from YouTube.
- youtube.com/watch?v=[VIDEO ID]
- youtube-nocookie.com
- youtube.com/shorts/[VIDEO ID]
- youtu.be/[VIDEO ID]
- youtube.com/embed/[VIDEO ID]
- youtube.com/e/[VIDEO ID]

> In Future There will be more Supported Platforms

## How To Install

1. Open :file_folder: `install.php` into your Browser, Link will be like `https://yourwebsite.com/install.php`
2. Select Color Palette
> For `Color Palette` Select box You have 4 Color Palettes Choose what you prefere from Them.
You Can See Palettes live Demo: [Palette 1](https://youbird.4up4.com/?p=1), [Palette 2](https://youbird.4up4.com/?p=2), [Palette 3](https://youbird.4up4.com/?p=3), [Palette 4](https://youbird.4up4.com/?p=4)

![Youbird Color Palettes](/assets/ybPalettes.png)

3. Enter your website informations like Website URL(or website link)
4. Enter Social Media Image Link

> `Social Media Image Link` Field for the image that appers when you paste your website link into social media

![Fields](/assets/fields.png)

5. On/Off Custom Download Page

> Custom Download Page: if it is On(**Recommended**) download link will be like `https://yourwebsite.com/download/?title=Example&mimetype=video/mp4&link=https://Source Url`, if it Off download link will be like `https://source Url`

3. After end filling data requested Press Install Button
4. For Security reasons Delete `install.php` form your website
5. Now Your website is ready
## Edit menu links

> **the side menu is stored in :file_folder: `menuLinks.json` in the main directory**

1. Open :file_folder: `menuLinks.json` file Content will be like below
``` json
{
    "menu": [
        {
            "text": "Download Video",
            "link": "#downloadYTVideos",
            "iconClass": "download",
            "iconColor": "color:rgb(160, 84, 84);"
        },
        {
            "text": "About Us",
            "link": "#about",
            "iconClass": "question-circle",
            "iconColor": "color:rgb(165, 79, 8);"
        },
        {
            "text": "Contact Us",
            "link": "#contact",
            "iconClass": "heart",
            "iconColor": "color:rgb(100, 15, 15);"
        }
    ]
}
```
2. You can Add, Edit Or Even Delete a menu item
3. In case you can not deal with code above contact with [Youbird Developer :technologist:](https://khamsat.com/user/almodheshplus2000)

## Advertisement Units

Youbird script has 4 adUnits stored in Home Directory by name `adUnit[ Unit Number ].html`
See this below to under stand:

![Advertisement Units](/assets/adunits.png)

## Edit Website Informations after installing

Current Youbird has no dashboard
All website setting are stored in Home Directory by name `settings.json`
file content maybe look like this:
``` json
{
    "palette": 2,
    "url": "http://localhost/all/Youbird",
    "title": "Youbird - Youtube video Downloader",
    "description": "Youbird - free youtube video downloader, easy to deal with",
    "keywords": "youtube,video downloader,youtube downloader,youtube video downloader,youbird,video,youtube video",
    "socialMediaImage": "./ogimage.png",
    "favicon": "./favicon.ico",
    "svgIcon": "./icon.svg",
    "pngIcon": "./icon.png",
    "logo": "./logo3.png",
    "boldText": "Free Online Video Downloader",
    "smallText": "Download video from YouTube for free",
    "copyrightText": "Designed with <i style=\"color: rgb(207, 15, 15);\" class=\"fa fa-heart\"></i> By Almodesh Plus&copy;",
    "customDownloadPage": true
}
```
In case you can not deal with code above contact with [Youbird Developer :technologist:](https://khamsat.com/user/almodheshplus2000)

## Add Code in head Tag

You Can add Custom code such as **Adsense Code, Gtag Code, Google Analytics, etc.**
1. Open `customHeadCode.html`
2. Add Code
3. Save

## Create Your Own Palette

All The data stored into `.json` files, You can find palettes in `colorPalettes` folder
To Create your own Palette:
1. Open :open_file_folder: `colorPalettes` Folder
2. Create a New json[^1] file and name it `palette.[ Any Number You Want ].json`
3. Open :file_folder: `palette.1.json` and Copy its content
4. Paste the content you just copied in the new file you just created(in step 1)
5. Edit it, add your own colours and open :file_folder: `settings.json` and edit `palette` to the nember enterd it(in step 2) and Save it
In case you can not deal with json code contact with [Youbird Developer :technologist:](https://khamsat.com/user/almodheshplus2000)

## Free Support

We Provide Free Technical Support For One Month, You can Contact with Us on [Khamsat](https://khamsat.com/user/almodheshplus2000)