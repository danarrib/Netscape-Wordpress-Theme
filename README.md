# Netscape Wordpress Theme

A Wordpress theme that works on legacy internet browsers like Netscape 3.0 and Internet Explorer 1.5.

Netscape 3.0 and Internet Explorer 1.5 can render pages using [HTML 3.2](https://www.w3.org/TR/2018/SPSD-html32-20180315/).

![Theme screenshot](https://user-images.githubusercontent.com/17026744/196312215-b69ba7fb-e98f-4a92-8f71-4dbd5d3bfe75.png)

Theme features:

- Uses only basic HTML 3.2 specifications.

- No Javascript, no CSS.

- Pages are automatically encoded in ISO-8859-1 charset during render, because UTF-8 doesn't work properly on old browsers. The HTTP headers are also fixed so modern browsers won't complain.

- Thumbnails and intermediate image sizes of PNG files are automatically generated in JPG, because PNG isn't supported by old browsers.

- Index page lists posts with Featured image thumbnails.

- Single and Page templates with Featured image.

- Search form, Categories and Archives list on sidebar.

- RSS Feeds are disabled (because, you know... New tech stuff).

- pot file included, so it'll be easy to translate the theme.

If you are into Retrocomputing and want to make a website that can be viewed on such old browsers, this is the theme for you.

Here are some tips:

- Do NOT use HTTPS. Netscape doesn't support HTTPS at all. Internet Explorer does support, but only very old implementations of SSL, which are deprecated on any modern web server. Just keep it simple and use regular plain and unsecure HTTP.

- Do not use PNG images. JPG and GIF works fine.

- Netscape 3 and IE1.5 supports Javascript, but their implementations are very different and simple programs can behave a lot different between both browsers. CSS is even worse.
