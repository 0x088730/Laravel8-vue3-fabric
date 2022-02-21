const mix = require('laravel-mix');
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
  module: {
    rules: [
      {
        test: /\.mjs$/,
        resolve: { fullySpecified: false },
        include: /node_modules/,
        type: "javascript/auto",
      },
      {
        test: /\.(postcss)$/,
        use: [
          "vue-style-loader",
          { loader: "css-loader", options: { importLoaders: 1 } },
          "postcss-loader",
        ],
      },
    ],
  },
  output: {
    publicPath: "/",
    //chunkFilename: mix.inProduction() ? 'js/chunks/[name].[chunkhash]   .js' : 'js/chunks/[name].js'
  },
  resolve: {
    extensions: [".js", ".json", ".vue"],
    alias: {
      "~": path.join(__dirname, "./resources/js"),
    },
  },
});
mix.js('resources/js/app.js', 'public/js')
  .vue()
  .version()
  .sass('resources/sass/app.scss', 'public/css')
  .css('resources/css/custom.css', 'public/css')
  .sourceMaps();
mix.browserSync(process.env.APP_URL);