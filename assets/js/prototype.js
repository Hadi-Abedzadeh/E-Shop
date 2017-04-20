/**
 * paginator.js
 * ------------
 * @author Jake Bellacera (http//github.com/jakebellacera)
 * @url    http://gist.github.com/3882977
 */

var Paginator = (function () {
  var Page;

  function Paginator(container, opts) {
    // Override any default settings
    this.settings = Object.extend({
      amount: 3,
      numbers: true,
      paddles: true,
      prevText: 'Previous',
      nextText: 'Next',
      onInvalidPage: function (n) {
        alert('Went to invalid page:' + n);
      }
    }, opts);

    // Set the container
    this.container = container;
  };

  Paginator.prototype.build = function () {
    var self = this;

    // Unset destroyed status
    self.destroyed = false;

    // Get the child elements
    self.children = self.container.childElements();

    // Pages accessor
    self.pages = [];

    // Set the current page to 0
    self.curPage = 0;

    // Create the pages' container
    self.wrap = new Element('div', {'class': 'pagination-pages'});
    self.container.insert(self.wrap);

    // Build the pages
    for (var i = 0; i < Math.ceil(self.children.length/self.settings.amount); i++) {
      self.pages.push( new Page( new Element('div', { 'class': 'page-' + (i+1)}) ) );
      self.wrap.insert(self.pages[i].node);

      // Put scoped child elements into the page
      self.children.slice(i * self.settings.amount, ((i+1) * self.settings.amount) || 9e9).each(function (child) {
        self.pages[i].add(child);
      });
    }

    // Build the navigation
    self.createNav();

    // Go to the first page
    self.goToPage(self.curPage);

    return self;
  };

  // Navigation builder
  Paginator.prototype.createNav = function () {
    var self = this, a;

    // Create the navigation container
    self.nav = new Element('div', { 'class': 'pagination-nav' });
    self.container.insert(self.nav);

    // Numbers navigation handler (1,2,3,4,etc)
    if (self.settings.numbers === true) {
      self.numbers = new Element('div', {'class': 'pagination-numbers'});

      for (var i = 0; i < self.pages.length; i++) {
        // Create a number URL
        a = new Element('a', {'href': '#'}).insert(i+1);
        a.on('click', function () {
          if (!this.hasClassName('active')) {
            self.goToPage(this.previousSiblings().length);
          }
          return false;
        });
        self.numbers.insert(a);
      }

      // Put numbers nav inside nav container
      self.nav.insert(self.numbers);
    }

    // Paddle navigation handler (next/prev)
    if (self.settings.paddles) {
      // Prev button
      self.prevPaddle = new Element('a', {'href': '#', 'class': 'pagination-paddle prev'}).insert(self.settings.prevText);
      self.prevPaddle.on('click', function () {
        if (!this.hasClassName('disabled')) {
          self.goToPage(self.curPage - 1);
        }
      });

      // Next button
      self.nextPaddle = new Element('a', {'href': '#', 'class': 'pagination-paddle next'}).insert(self.settings.nextText);
      self.nextPaddle.on('click', function () {
        if (!this.hasClassName('disabled')) {
          self.goToPage(self.curPage + 1);
        }
      });

      // Append paddle buttons to the navigation container
      self.nav.insert({
        top: self.prevPaddle,
        bottom: self.nextPaddle
      });
    }

    return self;
  }

  // Page traversing handler
  Paginator.prototype.goToPage = function (n) {
    var self = this;

    try {
      self.pages[n].node.show().siblings().each(function (siblingPage) {
        siblingPage.hide();
      });

      self.curPage = n;

      // Handle number nav
      if (self.settings.numbers) {
        self.numbers.childElements()[self.curPage].addClassName('active').siblings().each(function (sibling) {
          sibling.removeClassName('active');
        });
      }

      // Handle paddle nav
      if (self.settings.paddles) {
        if (self.curPage === 0) {
          self.prevPaddle.addClassName('disabled');
        } else {
          self.prevPaddle.removeClassName('disabled');
        }

        if (self.curPage === (self.pages.length - 1)) {
          self.nextPaddle.addClassName('disabled');
        } else {
          self.nextPaddle.removeClassName('disabled');
        }
      }

      return true;
    } catch (TypeError) { // NOTE: Probaby not the best way to do this...
      self.settings.onInvalidPage(n);
      return false;
    }

    return self;
  }

  // Completely remove Paginator
  Paginator.prototype.destroy = function () {
    var self = this;

    self.pages.each(function (page) {
      // Move elements back into container
      page.destroy(self.container);
    });

    // remove wrapper
    self.wrap.remove();

    // Remove navigation
    self.nav.remove();

    // Set destroyed status
    self.destroyed = true;

    return self;
  }

  Page = (function () {
    function Page(node) {
      this.node = node.hide();
      return this;
    }

    // Add a child element
    Page.prototype.add = function (ele) {
      return this.node.insert(ele);
    };

    // Move all child elements into a new location
    Page.prototype.destroy = function (newLocation) {
      var self = this;

      self.node.remove().childElements().each(function (child) {
        newLocation.insert(child);
      });
    };

    return Page;
  })();

  return Paginator;
})();