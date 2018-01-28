# Repository for OpenRailwayMap blog entries and styling

This repository contains the entries, templates and styling of the OpenRailwayMap blog.

## Setup

It is recommended to clone this Git repository to a location (called `$GIT_DIR`) outside the
document root (called `$DOCUMENT_ROOT` in this readme file) of the blog website.

* Add a symlink in the document root pointing to the `img/` directory of this Git repostory. Repeat
this for the directories containing the style sheets and JavaScript files.

```sh
cd $DOCUMENT_ROOT
ln -s $GIT_DIR/img img
ln -s $GIT_DIR/js js
ln -s $GIT_DIR/css css
ln -s de.atom de.rss
ln -s en.atom en.rss
```

* Add following to the configuration of your Apache web server:

```Apache
# permit access to /img, /js and /css because they point to locations outside of your document root
<Location /img>
    Require all granted
</Location>
<Location /js>
    Require all granted
</Location>
<Location /css>
    Require all granted
</Location>

Option +FollowSymLinks
```

* Clone the repository of the
[blog generation tool](https://github.com/Nakaner/static-blog-generator) to any location of your
choice and run it:

```sh
python3 $PATH_TO_TOOL/generate-pages.py -t templates/ -s src -o $DOCUMENT_ROOT config.json
```

## Adding a new blog entry

* Write the text, save it the German text at `src/de/ENTRY_ID.html.source` and the English text at
`src/en/ENTRY_ID.html.source`. `ENTRY_ID` is the ID of this blog entry (not used for public links).
* Add it to `config.json`:

```json
[
  {
    "id": "ENTRY_ID",
    "languages": {
      "en": {
        "authors": "Joe Awesome",
        "destination_path": "great-news-about-openrailwaymap",
        "subtitle": "",
        "title": "Great news about OpenRailwayMap"
      },
      "de": {
        "authors": "Joe Awesome",
        "destination_path": "tolle-neuigkeiten-ueber-die-openrailwaymap",
        "subtitle": "",
        "title": "Tolle Neuigkeiten über die OpenRailwayMap"
      }
    }
  },
  {
    "id": "https-support",
    "languages": {
      "de": {
        "authors": "Alexander Matheisen",
        "destination_path": "unterstuetzung-fuer-https",
        "subtitle": "",
        "title": "Unterstützung für HTTPS"
      },
      "en": {
        "authors": "Alexander Matheisen",
        "destination_path": "enabling-https",
        "subtitle": "",
        "title": "Enabling HTTPS"
      }
    }
  }
]
```

`id` is the ID of an entry. `title` is the title, `destination_path` will be part of the final
public URL of this entry (the pattern is `https://HOST/LANGUAGE/DESTINATION_PATH.html`). It is
recommended to choose a title which is similar to the title.

The date of first publication will be added automatically at the next run of the blog generation
tool. If you later modify it, these changes will be detected (except if your changes don't change
the MD5 hash :-)). If you have to set the date of publication manually, edit `pubdates.json`.
