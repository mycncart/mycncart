## For developers/contributors

If you wish to contribute, please do so by editing the jquery.flot.tooltip.source.js file.  The other .js files are built with Grunt and should not be directly edited.

When working with external plugin support, you can use the array plotPlugins (via this.plotPlugins), which is a collection of the names of the currently loaded Flot plugins.  For instance if checking for the existance of the official
symbol plugin, you would check `if ($.inArray('symbol', this.plotPlugins) !== -1)`.

There exists a Gruntfile.js for development purposes, but please do not commit built production or minified .js files when making a pull request.  Additionally, do not change the version, because the new version could vary depending on
when the pull request is merged and how many other changes were made at the same time.
