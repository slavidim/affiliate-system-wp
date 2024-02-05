const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const formatMessages = require('webpack-format-messages');
var path = require('path');

const outputPath = 'dist';
const localDomain = 'http://localhost:8888/plugin';

const entryPoints = {
  'app': ['./_dev/admin/js/app.js', './_dev/admin/scss/app.scss']
};

module.exports = {
  mode: 'development',
  stats: {
    children: false,
    assets: false,
    builtAt: false,
    hash: false,
    chunks: false,
    entrypoints: false,
  },
  entry: entryPoints,
  output: {
    path: path.resolve(__dirname, outputPath),
    filename: '[name].js',
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
    }),
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery'",
      "window.$": "jquery"
    }),

    // Uncomment this if you want to use CSS Live reload

    // new BrowserSyncPlugin({
    //   proxy: localDomain,
    //   files: [ outputPath + '/*.css' ],
    //   injectCss: true,
    // }, { reload: false, }),

  ],
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/, // .js and .jsx files
        exclude: /node_modules/, // excluding the node_modules folder
        use: {
          loader: "babel-loader",
        },
      },
      {
        test: /\.s?[c]ss$/i,
        exclude: /node_modules/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader',
          "postcss-loader",
        ],
      },
      {
        test: /\.(scss|css)$/,
        use: ['postcss-loader', 'sass-loader'],
      },
      {
        test: /\.sass$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'sass-loader',
            options: {
              sassOptions: { indentedSyntax: true },
              sourceMap: true
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              sourceMap: true,
              config: {
                path: 'postcss.config.js'
              }
            }
          },
        ],
      },
      {
        test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
        use: 'url-loader?limit=1024',
      },
    ]
  }
};