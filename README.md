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
* Customize the various theme properties in style.css as appropriate for your work.
* Review and modify style partials as needed. Note that the `assets/style.source/lib/` directory is intended for Sass partials that should remain as-is (such as Normalize). However, the rest are generally fair game.
