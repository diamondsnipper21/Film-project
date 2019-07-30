
exports.files = {
  javascripts: {
    joinTo: {
      'vendor.js': /^(?!app)/,
    	'app.js': /^app/,
    },
    order:{
      before:[
        "vendor/jquery.min.js",
        "vendor/jquery.blockUI.js",
      ]
    }
  },
  stylesheets: {
  	joinTo: {
      'vendor.css': /^(?!app)/,
  		'app.css': /^app/,
  	},
  }
}

exports.paths = {
    public: '../../public/home/custom/'
}

exports.plugins = {
  babel: {presets: ['latest', 'react', 'es2015']},
  pleeease: {
    sass: true,
    autoprefixer: {
      browsers: ['> 1%'],
    },
  },
}