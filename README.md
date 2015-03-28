# php-softwarelist

A small PHP application for generating structured products descriptions pages linked together; it just need as input a template HTML file and an XML file where the descriptions are stored.

## TODO
- code cleanup (mainly reduce code duplication);
- documentation;
- clear MVC separation (now there is only a View separation with the rest);
- support for multiple storing backends (not just XML, but maybe JSON? MySQL?);
- maybe remove the three level maximum nesting.

## A short backstory

One day I was searching how to use PHP as a very basic template engine to generate a bunch of web pages for describing some software structured in categories, products and subproducts and this is the end result.

The initial idea was found in a stackoverflow thread (I can't find the original thread, sorry) and some initial code was borrowed from there; I then added my custom template page, an XML file that stores the products' data (no database needed!) and some code for managing that data.