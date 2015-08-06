# strtr - A WordPress Starter Theme

This is a WordPress starter theme that was adapted from a Sass-based build of [Underscores](http://underscores.me/). Like Underscores, it's intended to be starting point for your own custom theme (rather than used as a parent theme).

Some notable differences from Underscores:

* The [Compass framework](http://compass-style.org/) (for Sass) is used for authoring styles
* The [Susy gridding library](http://susydocs.oddbird.net/) is used for layout
* A basic responsive layout with configurable breakpoint variables is ready for use out of the box
* The Sass/SCSS partials have been consolidated and re-organized to a flatter, simpler structure
* Style variables, definitions, and code comments are in place to allow for maintaining vertical rhythm
* Some additional (but minimal) styles have been incorporated to reduce the time to go from zero to presentable
* Fonts are sized with pixels rather than rems
* Sidebar widgets use h3 headers rather than h3

## Requirements

* Ruby and RubyGems
* The Bundler RubyGem

## Setup

* Add the root folder of this project to your `wp-content/themes/` directory and rename it as you'd like.
* Navigate to the root of the folder via CLI, and run this command: `bundle install`. That will install Compass and other dependencies (that's why you need Ruby, RubyGems, and Bundler installed).
* Activate the theme in your WordPress site.

## Compiling Styles

You'll use Compass to compile your Sass/SCSS to CSS. Navigate to the root directory of this theme via CLI and run one of these commands:

* For a one-time build: `compass compile`
* To have Compass monitor your Sass for changes and automatically compile whenever they occur: `compass watch` (you can stop the watch using the `ctrl-c` key command)

## Customization

This theme is intended to be customized as needed. Here's where to start:

* Do a multi-file search and replace of that folder, replacing the string `strtr` with a similar string that will be the name/unique prefix for methods (etc) your theme. The string you use here should:
    * Be alphanumeric (underscores are allowed, too)
    * Start with a letter
    * Not be too long
* Review and modify style partials as needed. Note that the `assets/style.source/lib/` directory is intended for Sass partials that should remain as-is (such as Normalize). However, the following are generally fair game:
    * `assets/style.source/style.scss` is where all of your partials are imported. Note the import order inside (and supporting comments about that order). In general, the idea is to import libs/partials with no output first, then go from most generic (Normalize, `_semantic.scss`) to most specific.
    * `assets/style.source/_base.scss` contains the primary Sass variables and configurations.
    * `assets/style.source/_misc.scss` is to house any styles that don't fit nicely anywhere else.
    * `assets/style.source/_mixins-custom.scss` is where you should place your mixins that are custom for your project.
    * `assets/style.source/_mixins-underscores.scss` contains some mixins ported over from Underscores.
    * `assets/style.source/_semantic.scss` is for styling semantic/vanilla HTML elements. There generally shouldn't be any reference to a class or ID-based selector inside here. Note that this partial (like most others) are loaded after Normalize.
    * `assets/style.source/_wp-comments.scss` includes styles related to display of comments.
    * `assets/style.source/_content.scss` includes styles related to display of content.
    * `assets/style.source/_layout.scss` is where the overall site layout and breakpoints are configured. You'll see code here that sets different numbers of container columns based on the breakpoints defined in `_base.scss`, and code that sets how many columns the content and sidebar areas should cover at those sizes, etc.
    * `assets/style.source/_wp-media.scss` for styles related to display of images, videos, galleries, etc.
    * `assets/style.source/_wp-menus.scss` for styling menus
    * `assets/style.source/_wp-utilities.scss` includes various helper classes, in particular those that are commonly used by WordPress (`.alignleft`, `.alignright`, etc).
    * `assets/style.source/_wp-widgets.scss` contains styles for widgets in general, as well specific widgets.
