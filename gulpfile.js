process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');
elixir(function(mix) {
    mix.sass([
        'app.scss'
    ], 'public/css');
});