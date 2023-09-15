const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
const WebpackNotifier = require('webpack-notifier');
const babelConfig = require('./babel.config.json');

module.exports = (env) => {
    return {
        mode: env.production ? 'production' : 'development',
        entry: {
            clientJS: [
                path.resolve(__dirname, `src/js/main.js`),
            ],
            clientCSS: [
                path.resolve(__dirname, `src/scss/main.scss`),
            ],
            editorCSS: [
                path.resolve(__dirname, `src/scss/editor.scss`),
            ],
            editor: [
                path.resolve(__dirname, `src/js/editor.js`),
            ],
            admin: [
                path.resolve(__dirname, `src/js/admin.js`),
            ],
        },
        output: {
            path: path.resolve(__dirname),
            filename: 'js/[name].js',
        },
        optimization: {
            usedExports: true,
            splitChunks: {
                maxInitialRequests: Infinity,
                cacheGroups: {
                    fortawesome: {
                        test: /[\\/]node_modules[\\/](@fortawesome)[\\/]/,
                        chunks: 'all',
                        name: 'fortawesome',
                        enforce: true,
                    },
                    vue: {
                        test: /[\\/]node_modules[\\/](vue)[\\/]/,
                        chunks: 'all',
                        name: 'vue',
                        enforce: true,
                    },
                },
            },
        },
        watch: !env.production,
        module: {
            rules: [
                {
                    test: /\.s[ac]ss$/i,
                    exclude: /node_modules/,
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                name: '[name].css',
                                outputPath: 'css',
                                esModule: false,
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: !env.production,
                                config: {
                                    path: 'postcss.config.js',
                                },
                            },
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: !env.production,
                                // Prefer `dart-sass`
                                implementation: require('sass'),
                            },
                        },
                    ],
                },
                {
                    test: /\.vue$/,
                    exclude: /node_modules/,
                    use: [
                        {
                            loader: 'vue-loader',
                        },
                    ],
                },
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader',
                    options: {
                        presets: babelConfig.presets,
                        plugins: babelConfig.plugins,
                    },
                },
            ],
        },
        resolve: {
            alias: {
                vue: 'vue/dist/vue.esm.js',
            }
        },
        plugins: [
            new MiniCssExtractPlugin({
                // Options similar to the same options in webpackOptions.output
                // all options are optional
                filename: 'css/[name].css',
                chunkFilename: '[id].css',
                ignoreOrder: false, // Enable to remove warnings about conflicting order
            }),
            new VueLoaderPlugin(),
            new WebpackNotifier({
                title: 'Passion Impact Build',
                contentImage: path.join(__dirname, 'build-icon.png'),
                alwaysNotify: true,
                skipFirstNotification: false,
                excludeWarnings: false,
            })
        ],
    };
};
