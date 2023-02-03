const TerserPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

module.exports = {
    mode: process.env.NODE_ENV || 'production',
    watch: process.env.NODE_ENV === 'development',
    entry: ['./resources/js/app.js', './resources/scss/app.scss'],
    output: {
        path: __dirname + '/public',
        filename: 'app.min.js'
    },
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()]
    },
    experiments: {
        topLevelAwait: true
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({ filename: '../public/app.min.css' }),
        new CopyWebpackPlugin(
            { 
                patterns: [
                    { from: 'resources/files', to: '../public' }
                ]
            }
        )
    ]
};