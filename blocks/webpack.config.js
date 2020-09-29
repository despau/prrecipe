const path              =   require( 'path' );
const webpack           =   require( 'webpack' );
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

module.exports          =   {
    entry:                  './app/index.js',
    output: {
        filename:           'bundle.js',
        path:               path.resolve( __dirname, './dist' ),
        publicPath:         ''
    },
    externals: {
        'react': 'React',
        'react-dom': 'ReactDOM',
      },
    mode:                   'development',
    watch:                  true,
    devtool:                'cheap-eval-source-map',
    module: {
        rules: [
            {
                test:       /\.js$/,
                exclude:    /(node_modules)/,
                use:        'babel-loader',
            }
        ]
    },
    plugins: [
        new DependencyExtractionWebpackPlugin(),
    ]
};
