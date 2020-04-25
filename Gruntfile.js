'use strict';

module.exports = function (grunt) {
  var tempDir = '.tmp';

  grunt.initConfig({
    regarde: {
      js: {
        files: 'frontend/**',
        tasks: ['rebuild-dev'],
        spawn: true
      }
    },

    copy: {
      dist: {
        files: [
          {
            expand: true,
            cwd: 'frontend/view',
            src: ['**/*.*'],
            dest: 'public/view'
          },
          {
            expand: true,
            cwd: 'frontend/fonts',
            src: ['**/*.*'],
            dest: 'public/fonts'
          }
        ]
      }
    },

    uglify: {
      public: {
        files: {
          'public/js/vendor.min.js': [
            '.tmp/js/vendor.js',
            '.tmp/js/template.js',
          ],
          'public/js/app.min.js': [
            '.tmp/js/app.js',
          ]
        }
      }
    },

    concat: {
      dist: {
        files: {
          'public/js/vendor.js': [
            'frontend/vendor/js-uml/build/UDCore.js',
            'frontend/vendor/js-uml/build/UDModules.js',
            'node_modules/lodash/lodash.js',
            'node_modules/jquery/dist/jquery.js',
            'frontend/tablesorter/jquery.tablesorter.js',
            'node_modules/angular/angular.js',
            'node_modules/angular-route/angular-route.js',
            'node_modules/angular-translate/dist/angular-translate.js',
            'node_modules/ng-table/dist/ng-table.js',
            'frontend/vendor/ng-resource/dist/ng-resource.js',
          ],
          'public/js/app.js': [
            tempDir + '/js/template.js',
            'frontend/js/app.js',
            'frontend/js/controller/**/*.js',
            'frontend/js/directive/**/*.js',
            'frontend/js/factory/**/*.js',
            'frontend/js/bootstrap.js',
            'frontend/js/service/**/*.js',
            'frontend/js/tablesorter/**/*.js',
          ],
          '.tmp/css/style.css': [
            'frontend/vendor/js-uml/build/css/UDStyle.css',
            'frontend/css/bootstrap.css',
            'frontend/css/sb-admin.css',
            'frontend/css/font-awesome.css',
          ]
        }
      }
    },

    clean: {
      js: [
        tempDir + '/**/*.js',
        tempDir + '/**/*.css',
      ]
    },

    ngtemplates: {
      useCase: {
        options: {
          url: '/'
        },
        cwd: 'frontend',
        src: ['view/**/*.html'],
        dest: tempDir + '/js/templates.js'
      }
    },

    cssmin: {
      target: {
        files: {
          'public/css/style.min.css': [
            tempDir + '/css/style.css',
          ]
        }
      }
    },

    connect: {
      server: {
        options: {
          port: 9001,
          base: 'public/'
        }
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-angular-templates');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-regarde');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-contrib-clean');

  grunt.registerTask('default', ['copy', 'ngtemplates', 'concat', 'cssmin', 'uglify', 'clean']);
  grunt.registerTask('rebuild-dev', ['default']);
  grunt.registerTask('server', ['rebuild-dev', 'connect', 'regarde']);
};