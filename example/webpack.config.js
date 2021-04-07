let Encore = require('@symfony/webpack-encore');

Encore
	.configureRuntimeEnvironment(process.env.NODE_ENV)
	.setOutputPath('www/dist')
	.setPublicPath('/dist')

	.addEntry('app', './src/app.ts')
	.addStyleEntry('main', './src/styles/main.scss')

	.enableSingleRuntimeChunk()
	.cleanupOutputBeforeBuild()
	.enableSourceMaps(!Encore.isProduction())
	.enableVersioning(true)

	.enableTypeScriptLoader()
	.enableSassLoader();

let config = Encore.getWebpackConfig();
config.resolve.fallback = {
	setImmediate: false,
	process: 'mock',
	dgram: 'empty',
	fs: 'empty',
	net: 'empty',
	tls: 'empty',
	child_process: 'empty',
};
module.exports = config;
