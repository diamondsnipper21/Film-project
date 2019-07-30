(function() {
  'use strict';

  var globals = typeof global === 'undefined' ? self : global;
  if (typeof globals.require === 'function') return;

  var modules = {};
  var cache = {};
  var aliases = {};
  var has = {}.hasOwnProperty;

  var expRe = /^\.\.?(\/|$)/;
  var expand = function(root, name) {
    var results = [], part;
    var parts = (expRe.test(name) ? root + '/' + name : name).split('/');
    for (var i = 0, length = parts.length; i < length; i++) {
      part = parts[i];
      if (part === '..') {
        results.pop();
      } else if (part !== '.' && part !== '') {
        results.push(part);
      }
    }
    return results.join('/');
  };

  var dirname = function(path) {
    return path.split('/').slice(0, -1).join('/');
  };

  var localRequire = function(path) {
    return function expanded(name) {
      var absolute = expand(dirname(path), name);
      return globals.require(absolute, path);
    };
  };

  var initModule = function(name, definition) {
    var hot = hmr && hmr.createHot(name);
    var module = {id: name, exports: {}, hot: hot};
    cache[name] = module;
    definition(module.exports, localRequire(name), module);
    return module.exports;
  };

  var expandAlias = function(name) {
    return aliases[name] ? expandAlias(aliases[name]) : name;
  };

  var _resolve = function(name, dep) {
    return expandAlias(expand(dirname(name), dep));
  };

  var require = function(name, loaderPath) {
    if (loaderPath == null) loaderPath = '/';
    var path = expandAlias(name);

    if (has.call(cache, path)) return cache[path].exports;
    if (has.call(modules, path)) return initModule(path, modules[path]);

    throw new Error("Cannot find module '" + name + "' from '" + loaderPath + "'");
  };

  require.alias = function(from, to) {
    aliases[to] = from;
  };

  var extRe = /\.[^.\/]+$/;
  var indexRe = /\/index(\.[^\/]+)?$/;
  var addExtensions = function(bundle) {
    if (extRe.test(bundle)) {
      var alias = bundle.replace(extRe, '');
      if (!has.call(aliases, alias) || aliases[alias].replace(extRe, '') === alias + '/index') {
        aliases[alias] = bundle;
      }
    }

    if (indexRe.test(bundle)) {
      var iAlias = bundle.replace(indexRe, '');
      if (!has.call(aliases, iAlias)) {
        aliases[iAlias] = bundle;
      }
    }
  };

  require.register = require.define = function(bundle, fn) {
    if (bundle && typeof bundle === 'object') {
      for (var key in bundle) {
        if (has.call(bundle, key)) {
          require.register(key, bundle[key]);
        }
      }
    } else {
      modules[bundle] = fn;
      delete cache[bundle];
      addExtensions(bundle);
    }
  };

  require.list = function() {
    var list = [];
    for (var item in modules) {
      if (has.call(modules, item)) {
        list.push(item);
      }
    }
    return list;
  };

  var hmr = globals._hmr && new globals._hmr(_resolve, require, modules, cache);
  require._cache = cache;
  require.hmr = hmr && hmr.wrap;
  require.brunch = true;
  globals.require = require;
})();

(function() {
var global = typeof window === 'undefined' ? this : window;
var __makeRelativeRequire = function(require, mappings, pref) {
  var none = {};
  var tryReq = function(name, pref) {
    var val;
    try {
      val = require(pref + '/node_modules/' + name);
      return val;
    } catch (e) {
      if (e.toString().indexOf('Cannot find module') === -1) {
        throw e;
      }

      if (pref.indexOf('node_modules') !== -1) {
        var s = pref.split('/');
        var i = s.lastIndexOf('node_modules');
        var newPref = s.slice(0, i).join('/');
        return tryReq(name, newPref);
      }
    }
    return none;
  };
  return function(name) {
    if (name in mappings) name = mappings[name];
    if (!name) return;
    if (name[0] !== '.' && pref) {
      var val = tryReq(name, pref);
      if (val !== none) return val;
    }
    return require(name);
  }
};
require.register("api.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Api = function () {
    function Api() {
        _classCallCheck(this, Api);
    }

    _createClass(Api, null, [{
        key: 'headers',
        value: function headers() {
            return {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + Api.token()
            };
        }
    }, {
        key: 'token',
        value: function token() {
            return $('meta[name="token"]').attr('content');
        }
    }]);

    return Api;
}();

exports.default = Api;


Api.images = {
    index: function index(page) {
        return fetch("/api/v1/images?page=" + page, {
            method: 'GET',
            headers: Api.headers()
        });
    }
};

Api.subtitles = {
    index: function index(page) {
        return fetch("/api/v1/subtitles?page=" + page, {
            method: 'GET',
            headers: Api.headers()
        });
    }
};

Api.videos = {
    index: function index(page, quality) {
        return fetch("/api/v1/videos?page=" + page + "&quality=" + quality, {
            method: 'GET',
            headers: Api.headers()
        });
    }
};

Api.movies = {
    index: function index(page) {
        return fetch("/api/v1/movies?page=" + page, {
            method: 'GET',
            headers: Api.headers()
        });
    },
    add_image: function add_image(movie_id, image_id) {
        return fetch("/api/v1/movies/" + movie_id + "/add_image?image_id=" + image_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_image: function remove_image(movie_id, image_id) {
        return fetch("/api/v1/movies/" + movie_id + "/remove_image?image_id=" + image_id, {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    update_featured_image: function update_featured_image(movie_id, image_id) {
        return fetch("/api/v1/movies/" + movie_id + "/update_featured_image?image_id=" + image_id, {
            method: 'POST',
            headers: Api.headers()
        });
    }
};

Api.series = {
    add_movie: function add_movie(series_id, movie_id) {
        return fetch("/api/v1/series/" + series_id + "/add_movie?movie_id=" + movie_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_image: function remove_image(series_id, image_id) {
        return fetch("/api/v1/series/" + series_id + "/remove_image?image_id=" + image_id, {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    add_image: function add_image(series_id, image_id) {
        return fetch("/api/v1/series/" + series_id + "/add_image?image_id=" + image_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    update_featured_image: function update_featured_image(series_id, image_id) {
        return fetch("/api/v1/series/" + series_id + "/update_featured_image?image_id=" + image_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_movie: function remove_movie(series_id, movie_id) {
        return fetch("/api/v1/series/" + series_id + "/remove_movie?movie_id=" + movie_id, {
            method: 'DELETE',
            headers: Api.headers()
        });
    }
};

Api.plays = {
    add_or_update_video: function add_or_update_video(play_id, quality, video_id) {
        return fetch("/api/v1/plays/" + play_id + "/add_or_update_video?quality=" + quality + "&video_id=" + video_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_video: function remove_video(play_id, video_id) {
        return fetch("/api/v1/plays/" + play_id + "/remove_video?video_id=" + video_id, {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    add_subtitle: function add_subtitle(play_id, subtitle_id) {
        return fetch("/api/v1/plays/" + play_id + "/add_subtitle?subtitle_id=" + subtitle_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_subtitle: function remove_subtitle(play_id, subtitle_id) {
        return fetch("/api/v1/plays/" + play_id + "/remove_subtitle?subtitle_id=" + subtitle_id, {
            method: 'DELETE',
            headers: Api.headers()
        });
    }
};

Api.products = {
    index: function index(page) {
        return fetch("/api/v1/products?page=" + page, {
            method: 'GET',
            headers: Api.headers()
        });
    },
    add_image: function add_image(product_id, image_id) {
        return fetch("/api/v1/products/" + product_id + "/add_image?image_id=" + image_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_image: function remove_image(product_id, image_id) {
        return fetch("/api/v1/products/" + product_id + "/remove_image?image_id=" + image_id, {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    update_featured_image: function update_featured_image(product_id, image_id) {
        return fetch("/api/v1/products/" + product_id + "/update_featured_image?image_id=" + image_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    tag: function tag(product_id, _tag) {
        return fetch("/api/v1/products/" + product_id + "/tag?tag=" + _tag, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    untag: function untag(product_id, tag) {
        return fetch("/api/v1/products/" + product_id + "/untag?tag=" + tag, {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    add_category: function add_category(product_id, category_slug) {
        return fetch("/api/v1/products/" + product_id + "/add_category?category=" + category_slug, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_category: function remove_category(product_id, category_slug) {
        return fetch("/api/v1/products/" + product_id + "/remove_category?category=" + category_slug, {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    add_plan: function add_plan(product_id, plan_id) {
        return fetch("/api/v1/products/" + product_id + "/add_plan?plan_id=" + plan_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    add_tagged_plans: function add_tagged_plans(product_id, tag) {
        return fetch("/api/v1/products/" + product_id + "/add_tagged_plans?tag=" + tag, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_plan: function remove_plan(product_id, plan_id) {
        return fetch("/api/v1/products/" + product_id + "/remove_plan?plan_id=" + plan_id, {
            method: 'DELETE',
            headers: Api.headers()
        });
    }
};

Api.categories = {
    add_product: function add_product(category_id, product_id) {
        return fetch("/api/v1/categories/" + category_id + "/add_product?product_id=" + product_id, {
            method: 'POST',
            headers: Api.headers()
        });
    },
    remove_product: function remove_product(category_id, product_id) {
        return fetch("/api/v1/categories/" + category_id + "/remove_product?product_id=" + product_id, {
            method: 'DELETE',
            headers: Api.headers()
        });
    },
    update_position: function update_position(category_id, target_category_id) {
        return fetch("/api/v1/categories/" + category_id + "/update_position?target_category_id=" + target_category_id, {
            method: 'PATCH',
            headers: Api.headers()
        });
    },
    update_featured_image: function update_featured_image(category_id, image_id) {
        return fetch("/api/v1/categories/" + category_id + "/update_featured_image?image_id=" + image_id, {
            method: 'PATCH',
            headers: Api.headers()
        });
    }
};

});

require.register("components/ImageList.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

var _PaginationBoxView = require('components/paginate/PaginationBoxView');

var _PaginationBoxView2 = _interopRequireDefault(_PaginationBoxView);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var ImageList = function (_React$Component) {
    _inherits(ImageList, _React$Component);

    function ImageList(props) {
        _classCallCheck(this, ImageList);

        var _this = _possibleConstructorReturn(this, (ImageList.__proto__ || Object.getPrototypeOf(ImageList)).call(this, props));

        _this.state = {
            error: null,
            items: [],
            data: {}
        };
        _this.handlePageClick = _this.handlePageClick.bind(_this);
        return _this;
    }

    _createClass(ImageList, [{
        key: 'loadImages',
        value: function loadImages(page) {
            var _this2 = this;

            $('#image-list').block({ message: 'Loading, please wait...' });
            return _api2.default.images.index(page).then(function (res) {
                return res.json();
            }).then(function (result) {
                $('#image-list').unblock();
                _this2.setState({
                    items: result.data,
                    data: result
                });
            }, function (error) {
                _this2.setState({
                    error: error
                });
            });
        }
    }, {
        key: 'handlePageClick',
        value: function handlePageClick(page) {
            this.loadImages(page.selected + 1);
        }
    }, {
        key: 'componentDidMount',
        value: function componentDidMount() {
            this.loadImages(1);
        }
    }, {
        key: 'render',
        value: function render() {
            var _state = this.state,
                error = _state.error,
                items = _state.items,
                data = _state.data;

            if (error) {
                return _react2.default.createElement(
                    'div',
                    null,
                    'Error: ',
                    error.message
                );
            } else {
                if (items.length == 0) return null;

                return _react2.default.createElement(
                    'div',
                    { className: 'text-center' },
                    _react2.default.createElement(
                        'div',
                        { className: 'row' },
                        items.map(function (item, index) {
                            return [_react2.default.createElement(
                                'div',
                                { className: 'col-sm-4', key: item.id },
                                _react2.default.createElement(
                                    'a',
                                    { href: 'javascript:void(0)', className: 'thumbnail widget widget-hover-effect1' },
                                    _react2.default.createElement('img', { src: item.url, alt: 'Image', onClick: function onClick(e) {
                                            return ImageList.onImageSelected(item, e);
                                        } })
                                )
                            ), _react2.default.createElement(
                                'div',
                                { className: index % 3 != 2 ? 'hidden' : '' },
                                _react2.default.createElement('div', { className: 'clearfix' })
                            )];
                        })
                    ),
                    _react2.default.createElement(_PaginationBoxView2.default, { previousLabel: "«",
                        nextLabel: "»",
                        breakLabel: _react2.default.createElement(
                            'a',
                            { href: '' },
                            '...'
                        ),
                        breakClassName: "break-me",
                        pageCount: data.last_page,
                        marginPagesDisplayed: 2,
                        pageRangeDisplayed: 3,
                        onPageChange: this.handlePageClick,
                        containerClassName: "pagination",
                        subContainerClassName: "pages pagination",
                        activeClassName: "active" })
                );
            }
        }
    }]);

    return ImageList;
}(_react2.default.Component);

exports.default = ImageList;


ImageList.onImageSelected = function () {};

});

require.register("components/SubtitleList.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

var _PaginationBoxView = require('components/paginate/PaginationBoxView');

var _PaginationBoxView2 = _interopRequireDefault(_PaginationBoxView);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var SubtitleList = function (_React$Component) {
    _inherits(SubtitleList, _React$Component);

    function SubtitleList(props) {
        _classCallCheck(this, SubtitleList);

        var _this = _possibleConstructorReturn(this, (SubtitleList.__proto__ || Object.getPrototypeOf(SubtitleList)).call(this, props));

        _this.state = {
            error: null,
            items: [],
            data: {}
        };
        _this.handlePageClick = _this.handlePageClick.bind(_this);
        return _this;
    }

    _createClass(SubtitleList, [{
        key: 'loadSubtitles',
        value: function loadSubtitles(page) {
            var _this2 = this;

            $('#subtitle-list').block({ message: 'Loading, please wait...' });
            _api2.default.subtitles.index(page).then(function (res) {
                return res.json();
            }).then(function (result) {
                $('#subtitle-list').unblock();
                _this2.setState({
                    items: result.data,
                    data: result
                });
            }, function (error) {
                _this2.setState({
                    error: error
                });
            });
        }
    }, {
        key: 'handlePageClick',
        value: function handlePageClick(page) {
            this.loadSubtitles(page.selected + 1);
        }
    }, {
        key: 'componentDidMount',
        value: function componentDidMount() {
            this.loadSubtitles(1);
        }
    }, {
        key: 'render',
        value: function render() {
            var _state = this.state,
                error = _state.error,
                items = _state.items,
                data = _state.data;

            if (error) {
                return _react2.default.createElement(
                    'div',
                    null,
                    'Error: ',
                    error.message
                );
            } else {

                return _react2.default.createElement(
                    'div',
                    null,
                    _react2.default.createElement(
                        'table',
                        { className: 'table table-bordered table-striped' },
                        _react2.default.createElement(
                            'thead',
                            null,
                            _react2.default.createElement(
                                'tr',
                                null,
                                _react2.default.createElement(
                                    'th',
                                    { className: 'col-sm-1' },
                                    'No'
                                ),
                                _react2.default.createElement(
                                    'th',
                                    { className: 'col-sm-2' },
                                    'language'
                                ),
                                _react2.default.createElement(
                                    'th',
                                    { className: '' },
                                    'url'
                                ),
                                _react2.default.createElement('th', null)
                            )
                        ),
                        _react2.default.createElement(
                            'tbody',
                            null,
                            items.map(function (item, index) {
                                return _react2.default.createElement(
                                    'tr',
                                    { key: item.id },
                                    _react2.default.createElement(
                                        'td',
                                        null,
                                        index + 1
                                    ),
                                    _react2.default.createElement(
                                        'td',
                                        null,
                                        item.language
                                    ),
                                    _react2.default.createElement(
                                        'td',
                                        null,
                                        item.url
                                    ),
                                    _react2.default.createElement(
                                        'td',
                                        null,
                                        _react2.default.createElement(
                                            'a',
                                            { href: 'javascript:void(0)', className: 'btn btn-primary', onClick: function onClick(e) {
                                                    return SubtitleList.onSubtitleSelected(item, e);
                                                } },
                                            _react2.default.createElement('i', { className: 'fa fa-check-circle' })
                                        )
                                    )
                                );
                            })
                        )
                    ),
                    _react2.default.createElement(_PaginationBoxView2.default, { previousLabel: "«",
                        nextLabel: "»",
                        breakLabel: _react2.default.createElement(
                            'a',
                            { href: '' },
                            '...'
                        ),
                        breakClassName: "break-me",
                        pageCount: data.last_page,
                        marginPagesDisplayed: 2,
                        pageRangeDisplayed: 3,
                        onPageChange: this.handlePageClick,
                        containerClassName: "pagination",
                        subContainerClassName: "pages pagination",
                        activeClassName: "active" })
                );
            }
        }
    }]);

    return SubtitleList;
}(_react2.default.Component);

exports.default = SubtitleList;


SubtitleList.onSubtitleSelected = function () {};

});

require.register("components/VideoList.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

var _PaginationBoxView = require('components/paginate/PaginationBoxView');

var _PaginationBoxView2 = _interopRequireDefault(_PaginationBoxView);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var VideoList = function (_React$Component) {
    _inherits(VideoList, _React$Component);

    function VideoList(props) {
        _classCallCheck(this, VideoList);

        var _this = _possibleConstructorReturn(this, (VideoList.__proto__ || Object.getPrototypeOf(VideoList)).call(this, props));

        _this.state = {
            error: null,
            items: [],
            data: {}
        };
        _this.handlePageClick = _this.handlePageClick.bind(_this);
        return _this;
    }

    _createClass(VideoList, [{
        key: 'loadVideos',
        value: function loadVideos(page) {
            var _this2 = this;

            $('#video-list').block({ message: 'Loading, please wait...' });
            _api2.default.videos.index(page, VideoList.quality).then(function (res) {
                return res.json();
            }).then(function (result) {
                $('#video-list').unblock();
                _this2.setState({
                    items: result.data,
                    data: result
                });
            }, function (error) {
                _this2.setState({
                    error: error
                });
            });
        }
    }, {
        key: 'handlePageClick',
        value: function handlePageClick(page) {
            this.loadVideos(page.selected + 1);
        }
    }, {
        key: 'componentDidMount',
        value: function componentDidMount() {
            this.loadVideos(1);
        }
    }, {
        key: 'render',
        value: function render() {
            var _state = this.state,
                error = _state.error,
                items = _state.items,
                data = _state.data;

            if (error) {
                return _react2.default.createElement(
                    'div',
                    null,
                    'Error: ',
                    error.message
                );
            } else {
                var pages = _underscore2.default.range(data.last_page);

                return _react2.default.createElement(
                    'div',
                    { className: 'text-center' },
                    _react2.default.createElement(
                        'div',
                        { className: 'row' },
                        items.map(function (item, index) {
                            return [_react2.default.createElement(
                                'div',
                                { className: 'col-sm-4', key: item.id },
                                _react2.default.createElement(
                                    'a',
                                    { href: 'javascript:void(0)', className: 'thumbnail widget widget-hover-effect1' },
                                    _react2.default.createElement('img', { src: item.featured_image ? item.featured_image.url : '', height: '49px', alt: 'Video', onClick: function onClick(e) {
                                            return VideoList.onVideoSelected(item, e);
                                        } }),
                                    _react2.default.createElement(
                                        'span',
                                        null,
                                        item.name,
                                        ', ',
                                        item.quality,
                                        ', ',
                                        item.duration,
                                        ' '
                                    )
                                )
                            ), _react2.default.createElement(
                                'div',
                                { className: index % 3 != 2 ? 'hidden' : '' },
                                _react2.default.createElement('div', { className: 'clearfix' })
                            )];
                        })
                    ),
                    _react2.default.createElement(_PaginationBoxView2.default, { previousLabel: "«",
                        nextLabel: "»",
                        breakLabel: _react2.default.createElement(
                            'a',
                            { href: '' },
                            '...'
                        ),
                        breakClassName: "break-me",
                        pageCount: data.last_page,
                        marginPagesDisplayed: 2,
                        pageRangeDisplayed: 3,
                        onPageChange: this.handlePageClick,
                        containerClassName: "pagination",
                        subContainerClassName: "pages pagination",
                        activeClassName: "active" })
                );
            }
        }
    }]);

    return VideoList;
}(_react2.default.Component);

exports.default = VideoList;


VideoList.onVideoSelected = function () {};
VideoList.quality = null;

});

require.register("components/movie/Series.jsx", function(exports, require, module) {
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require("react");

var _react2 = _interopRequireDefault(_react);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Series = function (_React$Component) {
    _inherits(Series, _React$Component);

    function Series(props) {
        _classCallCheck(this, Series);

        var _this = _possibleConstructorReturn(this, (Series.__proto__ || Object.getPrototypeOf(Series)).call(this, props));

        _this.state = {
            error: null,
            movie_id: props.movie_id,
            items: props.series
        };
        _this.onSeriesDelete = _this.onSeriesDelete.bind(_this);
        return _this;
    }

    _createClass(Series, [{
        key: "onSeriesDelete",
        value: function onSeriesDelete(series_id, e) {
            var _this2 = this;

            fetch("/api/v1/movies/" + this.state.movie_id + "/delete_series?series_id=" + series_id, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + $('meta[name="token"]').attr('content')
                }
            }).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this2.setState({
                    items: result
                });
            },
            // Note: it's important to handle errors here
            // instead of a catch() block so that we don't swallow
            // exceptions from actual bugs in components.
            function (error) {
                _this2.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: "componentDidMount",
        value: function componentDidMount() {}
        /*
            handleSelectedSeries(series, e){
        
                fetch("/api/v1/movies/" + this.state.movie_id + "/add_series",  {
                    method: 'POST',
                    headers: {
                      'Accept': 'application/json',
                      'Content-Type': 'application/json',
                      'Authorization': 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly93d3cuZmlsbS5jb20vYXBpL3Rva2VuIiwiaWF0IjoxNTI2MDMzMTcwLCJleHAiOjE1MjYwMzY3NzAsIm5iZiI6MTUyNjAzMzE3MCwianRpIjoidU1nd1dRNWphazdtWXM2WSJ9.FPuG4a0F95dh_W0tAm20Wo3EbLkUEd1ZS-9gFmDlz6M',
                    }
                })
                .then(res => res.json())
                .then(
                    (result) => {
                        this.setState({
                            items: result,
                        });
                    },
                    // Note: it's important to handle errors here
                    // instead of a catch() block so that we don't swallow
                    // exceptions from actual bugs in components.
                    (error) => {
                        this.setState({
                            isLoaded: true,
                            error
                        });
                    }
                )
            }*/

    }, {
        key: "render",
        value: function render() {
            var _this3 = this;

            var _state = this.state,
                error = _state.error,
                items = _state.items;


            return _react2.default.createElement(
                "div",
                { className: "row text-center" },
                items.map(function (item, index) {
                    return _react2.default.createElement(
                        "div",
                        { className: "col-sm-2", key: item.id },
                        _react2.default.createElement(
                            "a",
                            { href: "/admin/movies/" + _this3.state.movie_id + "/series/" + item.id + "/edit", className: "widget widget-hover-effect1" },
                            item.images && item.images.length > 0 ? _react2.default.createElement("img", { src: item.images[0].url, height: "149px", className: "img-thumbnail" }) : _react2.default.createElement("img", { src: "/img/placeholders/photos/photo1.jpg", height: "149px", className: "img-thumbnail" })
                        ),
                        _react2.default.createElement(
                            "a",
                            { href: "javascript:void(0)", className: "btn btn-danger btn-sm", onClick: function onClick(e) {
                                    return _this3.onSeriesDelete(item.id, e);
                                } },
                            _react2.default.createElement(
                                "span",
                                { className: "fa fa-trash" },
                                "\xA0REMOVE"
                            )
                        )
                    );
                }),
                _react2.default.createElement(
                    "div",
                    { className: "col-sm-2" },
                    _react2.default.createElement(
                        "a",
                        { href: "javascript:void(0)", className: "widget widget-hover-effect4", "data-toggle": "modal", "data-target": "#seriesModal" },
                        _react2.default.createElement(
                            "p",
                            null,
                            _react2.default.createElement(
                                "strong",
                                null,
                                "Add New Series"
                            )
                        )
                    )
                )
            );
        }
    }]);

    return Series;
}(_react2.default.Component);

exports.default = Series;

});

require.register("components/movie/Thumbnails.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _ImageList = require('components/ImageList');

var _ImageList2 = _interopRequireDefault(_ImageList);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Thumbnails = function (_React$Component) {
    _inherits(Thumbnails, _React$Component);

    function Thumbnails(props) {
        _classCallCheck(this, Thumbnails);

        var _this = _possibleConstructorReturn(this, (Thumbnails.__proto__ || Object.getPrototypeOf(Thumbnails)).call(this, props));

        _this.state = {
            error: null,
            movie_id: props.movie_id,
            items: props.images,
            featured_image: props.featured_image
        };
        _this.onImageRemove = _this.onImageRemove.bind(_this);
        _this.onUpdateFeaturedImage = _this.onUpdateFeaturedImage.bind(_this);
        return _this;
    }

    _createClass(Thumbnails, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            _ImageList2.default.onImageSelected = this.handleSelectedImage.bind(this);
        }
    }, {
        key: 'handleSelectedImage',
        value: function handleSelectedImage(image, e) {
            var _this2 = this;

            $('.modal').modal('hide');

            _api2.default.movies.add_image(this.state.movie_id, image.id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this2.setState({
                    items: result
                });
            }, function (error) {
                _this2.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'onImageRemove',
        value: function onImageRemove(image_id, e) {
            var _this3 = this;

            _api2.default.movies.remove_image(this.state.movie_id, image_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this3.setState({
                    items: result
                });
            }, function (error) {
                _this3.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'onUpdateFeaturedImage',
        value: function onUpdateFeaturedImage(image_id, e) {
            var _this4 = this;

            _api2.default.movies.update_featured_image(this.state.movie_id, image_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this4.setState({
                    featured_image: result
                });

                $('#thumbnail-image').attr('src', result.url);
            }, function (error) {
                _this4.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'render',
        value: function render() {
            var _this5 = this;

            var _state = this.state,
                error = _state.error,
                items = _state.items,
                featured_image = _state.featured_image;


            return _react2.default.createElement(
                'div',
                { className: 'gallery gallery-widget', 'data-toggle': 'lightbox-gallery' },
                _react2.default.createElement(
                    'div',
                    { className: 'row text-center' },
                    items.map(function (item, index) {
                        return _react2.default.createElement(
                            'div',
                            { className: 'col-sm-2', key: item.id },
                            _react2.default.createElement(
                                'a',
                                { href: item.url, className: 'gallery-link' },
                                _react2.default.createElement('img', { src: item.url })
                            ),
                            (featured_image == null || item.id != featured_image.id) && [_react2.default.createElement(
                                'a',
                                { href: 'javascript:void(0)', key: 'update', className: 'btn btn-success btn-sm', onClick: function onClick(e) {
                                        return _this5.onUpdateFeaturedImage(item.id, e);
                                    } },
                                _react2.default.createElement('span', { className: 'fa fa-check-circle' })
                            ), _react2.default.createElement(
                                'a',
                                { href: 'javascript:void(0)', key: 'remove', className: 'btn btn-danger btn-sm', onClick: function onClick(e) {
                                        return _this5.onImageRemove(item.id, e);
                                    } },
                                _react2.default.createElement('span', { className: 'fa fa-trash' })
                            )]
                        );
                    }),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-sm-2' },
                        _react2.default.createElement(
                            'a',
                            { href: 'javascript:void(0)', 'data-toggle': 'modal', 'data-target': '#imageModal', title: 'Add', className: 'btn btn-primary' },
                            _react2.default.createElement(
                                'i',
                                { className: 'fa fa-plus' },
                                'Add New Image'
                            )
                        )
                    )
                )
            );
        }
    }]);

    return Thumbnails;
}(_react2.default.Component);

exports.default = Thumbnails;

});

require.register("components/paginate/BreakView.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var BreakView = function BreakView(props) {
  var label = props.breakLabel;
  var className = props.breakClassName || 'break';

  return _react2.default.createElement(
    'li',
    { className: className, key: props.index },
    label
  );
};

exports.default = BreakView;

});

require.register("components/paginate/PageView.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var PageView = function PageView(props) {
  var cssClassName = props.pageClassName;
  var linkClassName = props.pageLinkClassName;
  var onClick = props.onClick;
  var href = props.href;
  var ariaLabel = 'Page ' + props.page + (props.extraAriaContext ? ' ' + props.extraAriaContext : '');
  var ariaCurrent = null;

  if (props.selected) {
    ariaCurrent = 'page';
    ariaLabel = 'Page ' + props.page + ' is your current page';
    if (typeof cssClassName !== 'undefined') {
      cssClassName = cssClassName + ' ' + props.activeClassName;
    } else {
      cssClassName = props.activeClassName;
    }
  }

  return _react2.default.createElement(
    'li',
    { className: cssClassName, key: props.index },
    _react2.default.createElement(
      'a',
      { onClick: onClick,
        className: linkClassName,
        href: href,
        tabIndex: '0',
        'aria-label': ariaLabel,
        'aria-current': ariaCurrent,
        onKeyPress: onClick },
      props.page
    )
  );
};

exports.default = PageView;

});

require.register("components/paginate/PaginationBoxView.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _classnames = require('classnames');

var _classnames2 = _interopRequireDefault(_classnames);

var _PageView = require('./PageView');

var _PageView2 = _interopRequireDefault(_PageView);

var _BreakView = require('./BreakView');

var _BreakView2 = _interopRequireDefault(_BreakView);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var PaginationBoxView = function (_Component) {
    _inherits(PaginationBoxView, _Component);

    function PaginationBoxView(props) {
        _classCallCheck(this, PaginationBoxView);

        var _this = _possibleConstructorReturn(this, (PaginationBoxView.__proto__ || Object.getPrototypeOf(PaginationBoxView)).call(this, props));

        _this.state = {
            selected: props.initialPage ? props.initialPage : props.forcePage ? props.forcePage : 0
        };
        return _this;
    }

    _createClass(PaginationBoxView, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            // Call the callback with the initialPage item:
            if (typeof this.props.initialPage !== 'undefined' && !this.props.disableInitialCallback) {
                this.callCallback(this.props.initialPage);
            }
        }
    }, {
        key: 'componentWillReceiveProps',
        value: function componentWillReceiveProps(nextProps) {
            if (typeof nextProps.forcePage !== 'undefined' && this.props.forcePage !== nextProps.forcePage) {
                this.setState({ selected: nextProps.forcePage });
            }
        }
    }, {
        key: 'handlePreviousPage',
        value: function handlePreviousPage(evt) {
            evt.preventDefault ? evt.preventDefault() : evt.returnValue = false;
            if (this.state.selected > 0) {
                this.handlePageSelected(this.state.selected - 1, evt);
            }
        }
    }, {
        key: 'handleNextPage',
        value: function handleNextPage(evt) {
            evt.preventDefault ? evt.preventDefault() : evt.returnValue = false;
            if (this.state.selected < this.props.pageCount - 1) {
                this.handlePageSelected(this.state.selected + 1, evt);
            }
        }
    }, {
        key: 'handlePageSelected',
        value: function handlePageSelected(selected, evt) {

            evt.preventDefault ? evt.preventDefault() : evt.returnValue = false;

            if (this.state.selected === selected) return;

            this.setState({ selected: selected });

            // Call the callback with the new selected item:
            this.callCallback(selected);
        }
    }, {
        key: 'hrefBuilder',
        value: function hrefBuilder(pageIndex) {
            if (this.props.hrefBuilder && pageIndex !== this.state.selected && pageIndex >= 0 && pageIndex < this.props.pageCount) {
                return this.props.hrefBuilder(pageIndex + 1);
            }
        }
    }, {
        key: 'callCallback',
        value: function callCallback(selectedItem) {
            if (typeof this.props.onPageChange !== "undefined" && typeof this.props.onPageChange === "function") {
                this.props.onPageChange({ selected: selectedItem });
            }
        }
    }, {
        key: 'getPageElement',
        value: function getPageElement(index) {
            return _react2.default.createElement(_PageView2.default, {
                index: index,
                onClick: this.handlePageSelected.bind(this, index),
                selected: this.state.selected === index,
                pageClassName: this.props.pageClassName,
                pageLinkClassName: this.props.pageLinkClassName,
                activeClassName: this.props.activeClassName,
                extraAriaContext: this.props.extraAriaContext,
                href: this.hrefBuilder(index),
                page: index + 1 });
        }
    }, {
        key: 'pagination',
        value: function pagination() {
            var _this2 = this;

            var items = {};

            if (this.props.pageCount <= this.props.pageRangeDisplayed) {

                for (var index = 0; index < this.props.pageCount; index++) {
                    items['key' + index] = this.getPageElement(index);
                }
            } else {

                var leftSide = this.props.pageRangeDisplayed / 2;
                var rightSide = this.props.pageRangeDisplayed - leftSide;

                if (this.state.selected > this.props.pageCount - this.props.pageRangeDisplayed / 2) {
                    rightSide = this.props.pageCount - this.state.selected;
                    leftSide = this.props.pageRangeDisplayed - rightSide;
                } else if (this.state.selected < this.props.pageRangeDisplayed / 2) {
                    leftSide = this.state.selected;
                    rightSide = this.props.pageRangeDisplayed - leftSide;
                }

                var _index = void 0;
                var page = void 0;
                var breakView = void 0;
                var createPageView = function createPageView(index) {
                    return _this2.getPageElement(index);
                };

                for (_index = 0; _index < this.props.pageCount; _index++) {

                    page = _index + 1;

                    if (page <= this.props.marginPagesDisplayed) {
                        items['key' + _index] = createPageView(_index);
                        continue;
                    }

                    if (page > this.props.pageCount - this.props.marginPagesDisplayed) {
                        items['key' + _index] = createPageView(_index);
                        continue;
                    }

                    if (_index >= this.state.selected - leftSide && _index <= this.state.selected + rightSide) {
                        items['key' + _index] = createPageView(_index);
                        continue;
                    }

                    var keys = Object.keys(items);
                    var breakLabelKey = keys[keys.length - 1];
                    var breakLabelValue = items[breakLabelKey];

                    if (this.props.breakLabel && breakLabelValue !== breakView) {
                        breakView = _react2.default.createElement(_BreakView2.default, {
                            index: _index,
                            breakLabel: this.props.breakLabel,
                            breakClassName: this.props.breakClassName });

                        items['key' + _index] = breakView;
                    }
                }
            }

            return items;
        }
    }, {
        key: 'render',
        value: function render() {
            var disabled = this.props.disabledClassName;

            var previousClasses = (0, _classnames2.default)(this.props.previousClassName, _defineProperty({}, disabled, this.state.selected === 0));

            var nextClasses = (0, _classnames2.default)(this.props.nextClassName, _defineProperty({}, disabled, this.state.selected === this.props.pageCount - 1));

            var pages = _underscore2.default.map(this.pagination(), function (item, index) {
                return item.type(item.props);
            });

            return _react2.default.createElement(
                'ul',
                { className: this.props.containerClassName },
                _react2.default.createElement(
                    'li',
                    { className: previousClasses },
                    _react2.default.createElement(
                        'a',
                        { onClick: this.handlePreviousPage.bind(this),
                            className: this.props.previousLinkClassName,
                            href: this.hrefBuilder(this.state.selected - 1),
                            tabIndex: '0',
                            onKeyPress: this.handlePreviousPage.bind(this) },
                        this.props.previousLabel
                    )
                ),
                pages,
                _react2.default.createElement(
                    'li',
                    { className: nextClasses },
                    _react2.default.createElement(
                        'a',
                        { onClick: this.handleNextPage.bind(this),
                            className: this.props.nextLinkClassName,
                            href: this.hrefBuilder(this.state.selected + 1),
                            tabIndex: '0',
                            onKeyPress: this.handleNextPage.bind(this) },
                        this.props.nextLabel
                    )
                )
            );
        }
    }]);

    return PaginationBoxView;
}(_react.Component);

exports.default = PaginationBoxView;
;

PaginationBoxView.propTypes = {
    pageCount: _propTypes2.default.number.isRequired,
    pageRangeDisplayed: _propTypes2.default.number.isRequired,
    marginPagesDisplayed: _propTypes2.default.number.isRequired,
    previousLabel: _propTypes2.default.node,
    nextLabel: _propTypes2.default.node,
    breakLabel: _propTypes2.default.node,
    hrefBuilder: _propTypes2.default.func,
    onPageChange: _propTypes2.default.func,
    initialPage: _propTypes2.default.number,
    forcePage: _propTypes2.default.number,
    disableInitialCallback: _propTypes2.default.bool,
    containerClassName: _propTypes2.default.string,
    pageClassName: _propTypes2.default.string,
    pageLinkClassName: _propTypes2.default.string,
    activeClassName: _propTypes2.default.string,
    previousClassName: _propTypes2.default.string,
    nextClassName: _propTypes2.default.string,
    previousLinkClassName: _propTypes2.default.string,
    nextLinkClassName: _propTypes2.default.string,
    disabledClassName: _propTypes2.default.string,
    breakClassName: _propTypes2.default.string
};

PaginationBoxView.defaultProps = {
    pageCount: 10,
    pageRangeDisplayed: 2,
    marginPagesDisplayed: 3,
    activeClassName: "selected",
    previousClassName: "previous",
    nextClassName: "next",
    previousLabel: "Previous",
    nextLabel: "Next",
    breakLabel: "...",
    disabledClassName: "disabled",
    disableInitialCallback: false
};

});

require.register("components/play/Subtitles.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

var _SubtitleList = require('components/SubtitleList');

var _SubtitleList2 = _interopRequireDefault(_SubtitleList);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Subtitles = function (_React$Component) {
    _inherits(Subtitles, _React$Component);

    function Subtitles(props) {
        _classCallCheck(this, Subtitles);

        var _this = _possibleConstructorReturn(this, (Subtitles.__proto__ || Object.getPrototypeOf(Subtitles)).call(this, props));

        _this.state = {
            error: null,
            play_id: props.play_id,
            items: props.subtitles
        };
        return _this;
    }

    _createClass(Subtitles, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            _SubtitleList2.default.onSubtitleSelected = this.handleSelectedSubtitle.bind(this);
        }
    }, {
        key: 'handleSelectedSubtitle',
        value: function handleSelectedSubtitle(subtitle, e) {
            var _this2 = this;

            $('.modal').modal('hide');

            _api2.default.plays.add_subtitle(this.state.play_id, subtitle.id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this2.setState({
                    items: result
                });
            }, function (error) {
                _this2.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'onSubtitleRemove',
        value: function onSubtitleRemove(subtitle_id, e) {
            var _this3 = this;

            _api2.default.plays.remove_subtitle(this.state.play_id, subtitle_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this3.setState({
                    items: result
                });
            }, function (error) {
                _this3.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'render',
        value: function render() {
            var _this4 = this;

            var _state = this.state,
                error = _state.error,
                play_id = _state.play_id,
                items = _state.items;

            if (error) {
                return _react2.default.createElement(
                    'div',
                    null,
                    'Error: ',
                    error.message
                );
            } else {
                return _react2.default.createElement(
                    'div',
                    null,
                    _react2.default.createElement(
                        'table',
                        { className: 'table table-bordered table-striped' },
                        _react2.default.createElement(
                            'thead',
                            null,
                            _react2.default.createElement(
                                'tr',
                                null,
                                _react2.default.createElement(
                                    'th',
                                    { className: 'col-sm-1' },
                                    'No'
                                ),
                                _react2.default.createElement(
                                    'th',
                                    { className: 'col-sm-2' },
                                    'language'
                                ),
                                _react2.default.createElement(
                                    'th',
                                    { className: '' },
                                    'url'
                                ),
                                _react2.default.createElement('th', null)
                            )
                        ),
                        _react2.default.createElement(
                            'tbody',
                            null,
                            items.map(function (item, index) {
                                return _react2.default.createElement(
                                    'tr',
                                    { key: item.id },
                                    _react2.default.createElement(
                                        'td',
                                        null,
                                        index + 1
                                    ),
                                    _react2.default.createElement(
                                        'td',
                                        null,
                                        item.language
                                    ),
                                    _react2.default.createElement(
                                        'td',
                                        null,
                                        item.url
                                    ),
                                    _react2.default.createElement(
                                        'td',
                                        null,
                                        _react2.default.createElement(
                                            'a',
                                            { href: 'javascript:void(0)', className: 'btn btn-danger btn-sm', onClick: function onClick(e) {
                                                    return _this4.onSubtitleRemove(item.id, e);
                                                } },
                                            _react2.default.createElement('i', { className: 'fa fa-trash' })
                                        )
                                    )
                                );
                            })
                        ),
                        _react2.default.createElement(
                            'tfoot',
                            null,
                            _react2.default.createElement(
                                'tr',
                                null,
                                _react2.default.createElement(
                                    'td',
                                    { colSpan: '4' },
                                    _react2.default.createElement(
                                        'a',
                                        { href: 'javascript:void(0)', className: 'btn btn-primary', 'data-toggle': 'modal', 'data-target': '#subtitleModal' },
                                        _react2.default.createElement('i', { className: 'fa fa-plus' })
                                    )
                                )
                            )
                        )
                    )
                );
            }
        }
    }]);

    return Subtitles;
}(_react2.default.Component);

exports.default = Subtitles;

});

require.register("components/play/Videos.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

var _VideoList = require('components/VideoList');

var _VideoList2 = _interopRequireDefault(_VideoList);

var _placeholder = require('placeholder');

var _placeholder2 = _interopRequireDefault(_placeholder);

var _videos_show = require('videos_show');

var _videos_show2 = _interopRequireDefault(_videos_show);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Videos = function (_React$Component) {
    _inherits(Videos, _React$Component);

    function Videos(props) {
        _classCallCheck(this, Videos);

        var _this = _possibleConstructorReturn(this, (Videos.__proto__ || Object.getPrototypeOf(Videos)).call(this, props));

        _this.state = {
            error: null,
            play_id: props.play_id,
            items: props.videos,
            qualitys: props.qualitys
        };
        return _this;
    }

    _createClass(Videos, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            _VideoList2.default.onVideoSelected = this.handleSelectedVideo.bind(this);
        }
    }, {
        key: 'onVideoSelect',
        value: function onVideoSelect(quality) {
            _VideoList2.default.quality = quality;

            Videos.page.unload_videos();
            Videos.page.load_videos();
        }
    }, {
        key: 'handleSelectedVideo',
        value: function handleSelectedVideo(video, e) {
            var _this2 = this;

            $('.modal').modal('hide');

            _api2.default.plays.add_or_update_video(this.state.play_id, _VideoList2.default.quality, video.id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this2.setState({
                    items: result
                });
            }, function (error) {
                _this2.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'onVideoRemove',
        value: function onVideoRemove(video_id) {
            var _this3 = this;

            _api2.default.plays.remove_video(this.state.play_id, video_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this3.setState({
                    items: result
                });
            }, function (error) {
                _this3.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'render',
        value: function render() {
            var _this4 = this;

            var _state = this.state,
                error = _state.error,
                play_id = _state.play_id,
                items = _state.items,
                qualitys = _state.qualitys;

            if (error) {
                return _react2.default.createElement(
                    'div',
                    null,
                    'Error: ',
                    error.message
                );
            } else {

                var videos = [];
                for (var i = 0; i < qualitys.length; i++) {
                    videos[i] = null;
                    for (var j = 0; j < items.length; j++) {
                        if (qualitys[i] == items[j].quality) {
                            videos[i] = items[j];
                            break;
                        }
                    }
                }

                return _react2.default.createElement(
                    'table',
                    { className: 'table table-bordered table-striped' },
                    _react2.default.createElement(
                        'thead',
                        null,
                        _react2.default.createElement(
                            'tr',
                            null,
                            _react2.default.createElement(
                                'th',
                                { className: 'col-sm-2' },
                                'Resolution'
                            ),
                            _react2.default.createElement(
                                'th',
                                { className: 'col-sm-2' },
                                'Featured'
                            ),
                            _react2.default.createElement(
                                'th',
                                { className: '' },
                                'Name'
                            ),
                            _react2.default.createElement(
                                'th',
                                { className: '' },
                                'Duration'
                            ),
                            _react2.default.createElement('th', { className: '' })
                        )
                    ),
                    _react2.default.createElement(
                        'tbody',
                        null,
                        videos.map(function (item, index) {
                            return _react2.default.createElement(
                                'tr',
                                { key: qualitys[index] },
                                _react2.default.createElement(
                                    'td',
                                    null,
                                    qualitys[index]
                                ),
                                _react2.default.createElement(
                                    'td',
                                    null,
                                    _react2.default.createElement(
                                        'a',
                                        { href: 'javascript:void(0)', 'data-toggle': 'modal', 'data-target': '#videoModal', title: 'Add', className: 'thumbnail widget widget-hover-effect1' },
                                        _react2.default.createElement('img', { src: item != null ? item.featured_image_url : _placeholder2.default.video.md, alt: 'featured', onClick: _this4.onVideoSelect.bind(_this4, qualitys[index]) })
                                    )
                                ),
                                item != null ? [_react2.default.createElement(
                                    'td',
                                    { key: 'name' },
                                    item.name
                                ), _react2.default.createElement(
                                    'td',
                                    { key: 'duration' },
                                    item.duration
                                ), _react2.default.createElement(
                                    'td',
                                    { key: 'action' },
                                    _react2.default.createElement(
                                        'a',
                                        { href: 'javascript:void(0)', className: 'btn btn-danger btn-sm', onClick: _this4.onVideoRemove.bind(_this4, item.id) },
                                        _react2.default.createElement('i', { className: 'fa fa-trash' })
                                    )
                                )] : [_react2.default.createElement('td', { key: 'name' }), _react2.default.createElement('td', { key: 'duration' }), _react2.default.createElement('td', { key: 'action' })]
                            );
                        })
                    )
                );
            }
        }
    }]);

    return Videos;
}(_react2.default.Component);

exports.default = Videos;


Videos.page = new _videos_show2.default();

});

require.register("components/product/Thumbnails.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _ImageList = require('components/ImageList');

var _ImageList2 = _interopRequireDefault(_ImageList);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Thumbnails = function (_React$Component) {
    _inherits(Thumbnails, _React$Component);

    function Thumbnails(props) {
        _classCallCheck(this, Thumbnails);

        var _this = _possibleConstructorReturn(this, (Thumbnails.__proto__ || Object.getPrototypeOf(Thumbnails)).call(this, props));

        _this.state = {
            error: null,
            product_id: props.product_id,
            items: props.images,
            featured_image: props.featured_image
        };
        _this.onImageRemove = _this.onImageRemove.bind(_this);
        _this.onUpdateFeaturedImage = _this.onUpdateFeaturedImage.bind(_this);
        return _this;
    }

    _createClass(Thumbnails, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            _ImageList2.default.onImageSelected = this.handleSelectedImage.bind(this);
        }
    }, {
        key: 'handleSelectedImage',
        value: function handleSelectedImage(image, e) {
            var _this2 = this;

            $('.modal').modal('hide');

            _api2.default.products.add_image(this.state.product_id, image.id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this2.setState({
                    items: result
                });
            }, function (error) {
                _this2.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'onImageRemove',
        value: function onImageRemove(image_id, e) {
            var _this3 = this;

            _api2.default.products.remove_image(this.state.product_id, image_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this3.setState({
                    items: result
                });
            }, function (error) {
                _this3.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'onUpdateFeaturedImage',
        value: function onUpdateFeaturedImage(image_id, e) {
            var _this4 = this;

            _api2.default.products.update_featured_image(this.state.product_id, image_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this4.setState({
                    featured_image: result
                });

                $('#thumbnail-image').attr('src', result.url);
            }, function (error) {
                _this4.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'render',
        value: function render() {
            var _this5 = this;

            var _state = this.state,
                error = _state.error,
                items = _state.items,
                featured_image = _state.featured_image;


            return _react2.default.createElement(
                'div',
                { className: 'gallery gallery-widget', 'data-toggle': 'lightbox-gallery' },
                _react2.default.createElement(
                    'div',
                    { className: 'row text-center' },
                    items.map(function (item, index) {
                        return _react2.default.createElement(
                            'div',
                            { className: 'col-sm-2', key: item.id },
                            _react2.default.createElement(
                                'a',
                                { href: item.url, className: 'gallery-link' },
                                _react2.default.createElement('img', { src: item.url })
                            ),
                            (featured_image == null || item.id != featured_image.id) && [_react2.default.createElement(
                                'a',
                                { href: 'javascript:void(0)', key: 'update', className: 'btn btn-success btn-sm', onClick: function onClick(e) {
                                        return _this5.onUpdateFeaturedImage(item.id, e);
                                    } },
                                _react2.default.createElement('span', { className: 'fa fa-check-circle' })
                            ), _react2.default.createElement(
                                'a',
                                { href: 'javascript:void(0)', key: 'remove', className: 'btn btn-danger btn-sm', onClick: function onClick(e) {
                                        return _this5.onImageRemove(item.id, e);
                                    } },
                                _react2.default.createElement('span', { className: 'fa fa-trash' })
                            )]
                        );
                    }),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-sm-2' },
                        _react2.default.createElement(
                            'a',
                            { href: 'javascript:void(0)', 'data-toggle': 'modal', 'data-target': '#imageModal', title: 'Add', className: 'btn btn-primary' },
                            _react2.default.createElement('i', { className: 'fa fa-plus' }),
                            ' Add New Image'
                        )
                    )
                )
            );
        }
    }]);

    return Thumbnails;
}(_react2.default.Component);

exports.default = Thumbnails;

});

require.register("components/series/MovieList.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

var _PaginationBoxView = require('components/paginate/PaginationBoxView');

var _PaginationBoxView2 = _interopRequireDefault(_PaginationBoxView);

var _placeholder = require('placeholder');

var _placeholder2 = _interopRequireDefault(_placeholder);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var MovieList = function (_React$Component) {
    _inherits(MovieList, _React$Component);

    function MovieList(props) {
        _classCallCheck(this, MovieList);

        var _this = _possibleConstructorReturn(this, (MovieList.__proto__ || Object.getPrototypeOf(MovieList)).call(this, props));

        _this.state = {
            error: null,
            items: [],
            data: {}
        };
        _this.handlePageClick = _this.handlePageClick.bind(_this);
        return _this;
    }

    _createClass(MovieList, [{
        key: 'loadMovies',
        value: function loadMovies(page) {
            var _this2 = this;

            $('#movie-list').block({ message: 'Loading, please wait...' });
            return _api2.default.movies.index(page).then(function (res) {
                return res.json();
            }).then(function (result) {
                $('#movie-list').unblock();
                _this2.setState({
                    items: result.data,
                    data: result
                });
            }, function (error) {
                _this2.setState({
                    error: error
                });
            });
        }
    }, {
        key: 'handlePageClick',
        value: function handlePageClick(page) {
            this.loadMovies(page.selected + 1);
        }
    }, {
        key: 'componentDidMount',
        value: function componentDidMount() {
            this.loadMovies(1);
        }
    }, {
        key: 'render',
        value: function render() {
            var _state = this.state,
                error = _state.error,
                items = _state.items,
                data = _state.data;

            if (error) {
                return _react2.default.createElement(
                    'div',
                    null,
                    'Error: ',
                    error.message
                );
            } else {
                if (items.length == 0) return null;

                return _react2.default.createElement(
                    'div',
                    { className: 'text-center' },
                    _react2.default.createElement(
                        'div',
                        { className: 'row' },
                        items.map(function (item, index) {
                            return [_react2.default.createElement(
                                'div',
                                { className: 'col-sm-4', key: item.id },
                                _react2.default.createElement(
                                    'a',
                                    { href: 'javascript:void(0)', className: 'thumbnail widget widget-hover-effect1' },
                                    _react2.default.createElement('img', { src: item.featured_image_url || _placeholder2.default.video.md, alt: 'Movie', onClick: function onClick(e) {
                                            return MovieList.onMovieSelected(item, e);
                                        } })
                                )
                            ), _react2.default.createElement(
                                'div',
                                { className: index % 3 != 2 ? 'hidden' : '' },
                                _react2.default.createElement('div', { className: 'clearfix' })
                            )];
                        })
                    ),
                    _react2.default.createElement(_PaginationBoxView2.default, { previousLabel: "«",
                        nextLabel: "»",
                        breakLabel: _react2.default.createElement(
                            'a',
                            { href: '' },
                            '...'
                        ),
                        breakClassName: "break-me",
                        pageCount: data.last_page,
                        marginPagesDisplayed: 2,
                        pageRangeDisplayed: 3,
                        onPageChange: this.handlePageClick,
                        containerClassName: "pagination",
                        subContainerClassName: "pages pagination",
                        activeClassName: "active" })
                );
            }
        }
    }]);

    return MovieList;
}(_react2.default.Component);

exports.default = MovieList;


MovieList.onMovieSelected = function () {};

});

require.register("components/series/Movies.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

var _placeholder = require('placeholder');

var _placeholder2 = _interopRequireDefault(_placeholder);

var _MovieList = require('components/series/MovieList');

var _MovieList2 = _interopRequireDefault(_MovieList);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Movie = function (_React$Component) {
    _inherits(Movie, _React$Component);

    function Movie(props) {
        _classCallCheck(this, Movie);

        var _this = _possibleConstructorReturn(this, (Movie.__proto__ || Object.getPrototypeOf(Movie)).call(this, props));

        _this.state = {
            error: null,
            series_id: props.series_id,
            items: props.movies
        };
        _this.onMovieRemove = _this.onMovieRemove.bind(_this);
        return _this;
    }

    _createClass(Movie, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            _MovieList2.default.onMovieSelected = this.handleSelectedMovie.bind(this);
        }
    }, {
        key: 'handleSelectedMovie',
        value: function handleSelectedMovie(movie, e) {
            var _this2 = this;

            $('.modal').modal('hide');

            _api2.default.series.add_movie(this.state.series_id, movie.id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this2.setState({
                    items: result
                });
            }, function (error) {
                _this2.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'onMovieRemove',
        value: function onMovieRemove(movie_id, e) {
            var _this3 = this;

            _api2.default.series.remove_movie(this.state.series_id, movie_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this3.setState({
                    items: result
                });
            }, function (error) {
                _this3.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'render',
        value: function render() {
            var _this4 = this;

            var _state = this.state,
                error = _state.error,
                items = _state.items;

            return _react2.default.createElement(
                'div',
                { className: 'gallery gallery-widget' },
                _react2.default.createElement(
                    'div',
                    { className: 'row text-center' },
                    items.map(function (item, index) {
                        return _react2.default.createElement(
                            'div',
                            { className: 'col-sm-2', key: item.id },
                            _react2.default.createElement(
                                'a',
                                { href: "/admin/movies/" + item.id + "/edit" },
                                _react2.default.createElement('img', { src: item.featured_image_url || _placeholder2.default.video.md, alt: 'Movie' })
                            ),
                            _react2.default.createElement(
                                'a',
                                { href: 'javascript:void(0)', className: 'btn btn-danger btn-sm', onClick: function onClick(e) {
                                        return _this4.onMovieRemove(item.id, e);
                                    } },
                                _react2.default.createElement(
                                    'i',
                                    { className: 'fa fa-trash' },
                                    '\xA0REMOVE'
                                )
                            )
                        );
                    }),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-sm-2' },
                        _react2.default.createElement(
                            'a',
                            { href: 'javascript: void(0);', 'data-toggle': 'modal', 'data-target': '#movieModal', title: 'Add', className: 'btn btn-primary' },
                            _react2.default.createElement(
                                'i',
                                { className: 'fa fa-plus' },
                                'Add New Movie'
                            )
                        )
                    )
                )
            );
        }
    }]);

    return Movie;
}(_react2.default.Component);

exports.default = Movie;

});

require.register("components/series/Thumbnails.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _underscore = require('underscore');

var _underscore2 = _interopRequireDefault(_underscore);

var _ImageList = require('components/ImageList');

var _ImageList2 = _interopRequireDefault(_ImageList);

var _api = require('api');

var _api2 = _interopRequireDefault(_api);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Thumbnails = function (_React$Component) {
    _inherits(Thumbnails, _React$Component);

    function Thumbnails(props) {
        _classCallCheck(this, Thumbnails);

        var _this = _possibleConstructorReturn(this, (Thumbnails.__proto__ || Object.getPrototypeOf(Thumbnails)).call(this, props));

        _this.state = {
            error: null,
            series_id: props.series_id,
            items: props.images,
            featured_image: props.featured_image
        };
        _this.onImageRemove = _this.onImageRemove.bind(_this);
        _this.onUpdateFeaturedImage = _this.onUpdateFeaturedImage.bind(_this);
        return _this;
    }

    _createClass(Thumbnails, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            _ImageList2.default.onImageSelected = this.handleSelectedImage.bind(this);
        }
    }, {
        key: 'onImageRemove',
        value: function onImageRemove(image_id, e) {
            var _this2 = this;

            _api2.default.series.remove_image(this.state.series_id, image_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this2.setState({
                    items: result
                });
            }, function (error) {
                _this2.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'handleSelectedImage',
        value: function handleSelectedImage(image, e) {
            var _this3 = this;

            $('.modal').modal('hide');

            _api2.default.series.add_image(this.state.series_id, image.id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this3.setState({
                    items: result
                });
            }, function (error) {
                _this3.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'onUpdateFeaturedImage',
        value: function onUpdateFeaturedImage(image_id, e) {
            var _this4 = this;

            _api2.default.series.update_featured_image(this.state.series_id, image_id).then(function (res) {
                return res.json();
            }).then(function (result) {
                _this4.setState({
                    featured_image: result
                });

                $('#thumbnail-image').attr('src', result.url);
            }, function (error) {
                _this4.setState({
                    isLoaded: true,
                    error: error
                });
            });
        }
    }, {
        key: 'render',
        value: function render() {
            var _this5 = this;

            var _state = this.state,
                error = _state.error,
                featured_image = _state.featured_image,
                items = _state.items;


            return _react2.default.createElement(
                'div',
                { className: 'gallery gallery-widget', 'data-toggle': 'lightbox-gallery' },
                _react2.default.createElement(
                    'div',
                    { className: 'row text-center' },
                    items.map(function (item, index) {
                        return _react2.default.createElement(
                            'div',
                            { className: 'col-sm-2', key: item.id },
                            _react2.default.createElement(
                                'a',
                                { href: item.url, className: 'gallery-link' },
                                _react2.default.createElement('img', { src: item.url })
                            ),
                            (featured_image == null || item.id != featured_image.id) && [_react2.default.createElement(
                                'a',
                                { href: 'javascript:void(0)', key: 'update', className: 'btn btn-success btn-sm', onClick: function onClick(e) {
                                        return _this5.onUpdateFeaturedImage(item.id, e);
                                    } },
                                _react2.default.createElement('span', { className: 'fa fa-check-circle' })
                            ), _react2.default.createElement(
                                'a',
                                { href: 'javascript:void(0)', key: 'remove', className: 'btn btn-danger btn-sm', onClick: function onClick(e) {
                                        return _this5.onImageRemove(item.id, e);
                                    } },
                                _react2.default.createElement('span', { className: 'fa fa-trash' })
                            )]
                        );
                    }),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-sm-2' },
                        _react2.default.createElement(
                            'a',
                            { href: 'javascript:void(0)', 'data-toggle': 'modal', 'data-target': '#imageModal', title: 'Add', className: 'btn btn-primary' },
                            _react2.default.createElement(
                                'i',
                                { className: 'fa fa-plus' },
                                'Add New Image'
                            )
                        )
                    )
                )
            );
        }
    }]);

    return Thumbnails;
}(_react2.default.Component);

exports.default = Thumbnails;

});

require.register("images_show.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _ImageList = require('components/ImageList');

var _ImageList2 = _interopRequireDefault(_ImageList);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var ImagesShow = function () {
    function ImagesShow() {
        _classCallCheck(this, ImagesShow);
    }

    _createClass(ImagesShow, [{
        key: 'load_images',
        value: function load_images() {
            _reactDom2.default.render(_react2.default.createElement(_ImageList2.default, null), $('#imageList')[0]);
        }
    }, {
        key: 'unload_images',
        value: function unload_images() {
            _reactDom2.default.unmountComponentAtNode($('#imageList')[0]);
        }
    }]);

    return ImagesShow;
}();

exports.default = ImagesShow;

});

require.register("movies_edit.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _Thumbnails = require('components/movie/Thumbnails');

var _Thumbnails2 = _interopRequireDefault(_Thumbnails);

var _MovieList = require('components/series/MovieList');

var _MovieList2 = _interopRequireDefault(_MovieList);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var MoviesEdit = function () {
    function MoviesEdit() {
        _classCallCheck(this, MoviesEdit);
    }

    _createClass(MoviesEdit, [{
        key: 'init',
        value: function init(movie, images) {
            this.init_images(movie);
        }
    }, {
        key: 'init_images',
        value: function init_images(movie) {
            _reactDom2.default.render(_react2.default.createElement(_Thumbnails2.default, { movie_id: movie.id, images: movie.images, featured_image: movie.featured_image }), $('#thumbnailList')[0]);
        }
    }]);

    return MoviesEdit;
}();

exports.default = MoviesEdit;

});

require.register("movies_modal.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _Thumbnails = require('components/movie/Thumbnails');

var _Thumbnails2 = _interopRequireDefault(_Thumbnails);

var _MovieList = require('components/series/MovieList');

var _MovieList2 = _interopRequireDefault(_MovieList);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var MoviesModal = function () {
    function MoviesModal() {
        _classCallCheck(this, MoviesModal);
    }

    _createClass(MoviesModal, [{
        key: 'load_movies',
        value: function load_movies() {
            _reactDom2.default.render(_react2.default.createElement(_MovieList2.default, null), $('#movieList')[0]);
        }
    }]);

    return MoviesModal;
}();

exports.default = MoviesModal;

});

require.register("placeholder.jsx", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Placeholder = function Placeholder() {
	_classCallCheck(this, Placeholder);
};

exports.default = Placeholder;


Placeholder.video = {
	sm: '/img/placeholders/photos/photo1.jpg',
	md: '/img/placeholders/photos/photo1.jpg',
	lg: '/img/placeholders/photos/photo1.jpg'
};

});

require.register("plays_edit.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _VideoList = require('components/VideoList');

var _VideoList2 = _interopRequireDefault(_VideoList);

var _Subtitles = require('components/play/Subtitles');

var _Subtitles2 = _interopRequireDefault(_Subtitles);

var _Videos = require('components/play/Videos');

var _Videos2 = _interopRequireDefault(_Videos);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var PlaysEdit = function () {
    function PlaysEdit() {
        _classCallCheck(this, PlaysEdit);
    }

    _createClass(PlaysEdit, [{
        key: 'init',
        value: function init(play, qualitys) {
            this.load_subtitles(play);
            this.load_videos(play, qualitys);
        }
    }, {
        key: 'load_subtitles',
        value: function load_subtitles(play) {
            _reactDom2.default.render(_react2.default.createElement(_Subtitles2.default, { play_id: play.id, subtitles: play.subtitles }), $('#subtitles')[0]);
        }
    }, {
        key: 'load_videos',
        value: function load_videos(play, qualitys) {
            _reactDom2.default.render(_react2.default.createElement(_Videos2.default, { play_id: play.id, videos: play.videos, qualitys: qualitys }), $('#videos')[0]);
        }
    }]);

    return PlaysEdit;
}();

exports.default = PlaysEdit;

});

require.register("products_edit.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _Thumbnails = require('components/product/Thumbnails');

var _Thumbnails2 = _interopRequireDefault(_Thumbnails);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var ProductsEdit = function () {
    function ProductsEdit() {
        _classCallCheck(this, ProductsEdit);
    }

    _createClass(ProductsEdit, [{
        key: 'init',
        value: function init(product) {
            this.init_images(product);
        }
    }, {
        key: 'init_images',
        value: function init_images(product) {
            _reactDom2.default.render(_react2.default.createElement(_Thumbnails2.default, { product_id: product.id, images: product.images, featured_image: product.featured_image }), $('#thumbnailList')[0]);
        }
    }]);

    return ProductsEdit;
}();

exports.default = ProductsEdit;

});

require.register("series_edit.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _Thumbnails = require('components/series/Thumbnails');

var _Thumbnails2 = _interopRequireDefault(_Thumbnails);

var _Movies = require('components/series/Movies');

var _Movies2 = _interopRequireDefault(_Movies);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var SeriesEdit = function () {
    function SeriesEdit() {
        _classCallCheck(this, SeriesEdit);
    }

    _createClass(SeriesEdit, [{
        key: 'init',
        value: function init(series) {
            this.init_images(series);
            this.init_movies(series);
        }
    }, {
        key: 'init_images',
        value: function init_images(series) {
            _reactDom2.default.render(_react2.default.createElement(_Thumbnails2.default, { series_id: series.id, images: series.images, featured_image: series.featured_image }), $('#thumbnailList')[0]);
        }
    }, {
        key: 'init_movies',
        value: function init_movies(series) {
            _reactDom2.default.render(_react2.default.createElement(_Movies2.default, { series_id: series.id, movies: series.movies }), $('#movies')[0]);
        }
    }]);

    return SeriesEdit;
}();

exports.default = SeriesEdit;

});

require.register("subtitles_show.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _SubtitleList = require('components/SubtitleList');

var _SubtitleList2 = _interopRequireDefault(_SubtitleList);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var SubtitlesShow = function () {
    function SubtitlesShow() {
        _classCallCheck(this, SubtitlesShow);
    }

    _createClass(SubtitlesShow, [{
        key: 'load_subtitles',
        value: function load_subtitles() {
            _reactDom2.default.render(_react2.default.createElement(_SubtitleList2.default, null), $('#subtitleList')[0]);
        }
    }, {
        key: 'unload_subtitles',
        value: function unload_subtitles() {
            _reactDom2.default.unmountComponentAtNode($('#subtitleList')[0]);
        }
    }]);

    return SubtitlesShow;
}();

exports.default = SubtitlesShow;

});

require.register("videos_show.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _VideoList = require('components/VideoList');

var _VideoList2 = _interopRequireDefault(_VideoList);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var VideosShow = function () {
    function VideosShow() {
        _classCallCheck(this, VideosShow);
    }

    _createClass(VideosShow, [{
        key: 'load_videos',
        value: function load_videos() {
            _reactDom2.default.render(_react2.default.createElement(_VideoList2.default, null), $('#videoList')[0]);
        }
    }, {
        key: 'unload_videos',
        value: function unload_videos() {
            _reactDom2.default.unmountComponentAtNode($('#videoList')[0]);
        }
    }]);

    return VideosShow;
}();

exports.default = VideosShow;

});

require.register("___globals___", function(exports, require, module) {
  
});})();require('___globals___');


//# sourceMappingURL=app.js.map