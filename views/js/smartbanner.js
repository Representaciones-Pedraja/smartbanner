(function (global, $) {
  'use strict';

  var Bakery = {
      bake: function (name, value, days) {
          var expires = '';
          if (days) {
              var date = new Date();
              date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
              expires = "; expires=" + date.toUTCString();
          }
          document.cookie = name + "=" + (value || "") + expires + "; path=/";
      },
      read: function (name) {
          var nameEQ = name + "=";
          var ca = document.cookie.split(';');
          for (var i = 0; i < ca.length; i++) {
              var c = ca[i];
              while (c.charAt(0) === ' ') c = c.substring(1, c.length);
              if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
          }
          return null;
      },
      erase: function (name) {
          this.bake(name, '', -1);
      }
  };

  var Detector = {
      platform: function () {
          var userAgent = navigator.userAgent.toLowerCase();
          if (/android/.test(userAgent)) {
              return 'android';
          } else if (/iphone|ipad|ipod/.test(userAgent)) {
              return 'ios';
          }
          return 'desktop';
      }
  };

  function SmartBanner(options) {
      this.options = $.extend({}, SmartBanner.defaults, options);
      this.$banner = $('<div class="smartbanner"></div>');
      this.$banner.append('<span class="smartbanner-title">' + this.options.title + '</span>');
      this.$banner.append('<a class="smartbanner-button" href="' + this.options.url + '">' + this.options.button + '</a>');
      this.$banner.append('<a class="smartbanner-close">×</a>');

      this.init();
  }

  SmartBanner.defaults = {
      title: 'Get our App',
      button: 'Install',
      url: '#',
      daysHidden: 15,
      daysReminder: 90,
  };

  SmartBanner.prototype.init = function () {
      this.checkCookie();
      this.addEventListeners();
      this.showBanner();
  };

  SmartBanner.prototype.checkCookie = function () {
      if (Bakery.read('smartbanner')) {
          this.hideBanner();
      }
  };

  SmartBanner.prototype.showBanner = function () {
      var platform = Detector.platform();
      if (platform !== 'desktop') {
          $('body').append(this.$banner);
          this.$banner.fadeIn();
      }
  };

  SmartBanner.prototype.hideBanner = function () {
      this.$banner.remove();
  };

  SmartBanner.prototype.addEventListeners = function () {
      var self = this;
      this.$banner.on('click', '.smartbanner-close', function () {
          Bakery.bake('smartbanner', 'true', self.options.daysHidden);
          self.hideBanner();
      });
      this.$banner.on('click', '.smartbanner-button', function () {
          Bakery.bake('smartbanner', 'true', self.options.daysReminder);
      });
  };

  $(document).ready(function () {
      new SmartBanner({
          title: 'Get our App',
          button: 'Install',
          url: 'https://example.com/app-download',
          daysHidden: 15,
          daysReminder: 90,
      });
  });

}(window, jQuery));