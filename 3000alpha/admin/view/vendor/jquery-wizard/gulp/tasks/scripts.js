'use strict';

import config       from '../../config';
import gulp         from 'gulp';
import babel        from 'gulp-babel';
import gulpif       from 'gulp-if';
import sourcemaps   from 'gulp-sourcemaps';
import handleErrors from '../util/handleErrors';
import getSrcFiles  from '../util/getSrcFiles';
import browser      from 'browser-sync';
import header       from 'gulp-header';
import rename       from 'gulp-rename';
import rollup       from 'gulp-rollup';
import uglify       from 'gulp-uglify';
import size         from 'gulp-size';
import plumber      from 'gulp-plumber';
import beautify     from '../util/beautify';
import path         from 'path';
import notify       from 'gulp-notify';

export function bundler(src = config.scripts.src, dest = config.scripts.dest, entry = config.scripts.entry, files = config.scripts.files, message = 'Bundler task complete') {
  return function () {
    let srcFiles = getSrcFiles(src, files);

    return gulp.src(srcFiles)
      .on('error', handleErrors)
      .pipe(plumber({errorHandler: handleErrors}))
      .pipe(rollup({
        allowRealFiles: true,
        entry: `${src}/${entry}`
      }))
      .pipe(header(config.banner))
      .pipe(rename({
        suffix: '.es'
      }))
      .pipe(gulp.dest(dest))
      .pipe(notify({
        title: config.notify.title,
        message: message,
        onLast: true
      }));
  };
}

export function scripts(src = config.scripts.src, dest = config.scripts.dest, entry = config.scripts.entry, files = config.scripts.files, message = 'Scripts task complete') {
  const createSourcemap = config.deploy || config.scripts.prodSourcemap;

  return function () {
    let srcFiles = getSrcFiles(src, files);

    return gulp.src(srcFiles)
      .on('error', handleErrors)
      .pipe(plumber({errorHandler: handleErrors}))
      .pipe(rollup({
        allowRealFiles: true,
        entry: `${src}/${entry}`
      }))
      .pipe(babel({
        plugins: ['transform-es2015-modules-umd']
      }))
      .pipe(header(config.banner))
      .pipe(beautify({
        config: path.join(config.paths.root, '.beautifyrc')
      }))
      .pipe(gulp.dest(dest))
      .pipe(size({
        title: 'scripts',
        showFiles: true
      }))
      .pipe(rename({
        suffix: '.min'
      }))
      .pipe(gulpif(createSourcemap, sourcemaps.init()))
      .pipe(uglify())
      .pipe(header(config.banner))
      .pipe(gulpif(
        createSourcemap,
        sourcemaps.write(config.deploy ? './' : null))
      )
      .pipe(gulp.dest(dest))
      .pipe(size({
        title: 'minified scripts',
        showFiles: true
      }))
      .pipe(browser.stream())
      .pipe(notify({
        title: config.notify.title,
        message: message,
        onLast: true
      }));
  };
}
