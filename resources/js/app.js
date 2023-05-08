/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });


var alert_del = document.querySelectorAll('.alert-del');
  alert_del.forEach((x) =>
    x.addEventListener('click', function () {
      x.parentElement.classList.add('hidden');
    })
  );


// Tratamento para campos do tipo currency
var currencyInput = document.querySelectorAll( 'input[type="currency"]' );

for ( var i = 0; i < currencyInput.length; i++ ) {

    var currency = 'BRL'
    onBlur( {
        target: currencyInput[ i ]
    } )

    currencyInput[ i ].addEventListener( 'focus', onFocus )
    currencyInput[ i ].addEventListener( 'blur', onBlur )

    function localStringToNumber( s ) {
        s = String( s ).replace("R$ ", "" );
        return ( String (s) );
    }

    function onFocus( e ) {
        var value = e.target.value;
        e.target.value = value ? localStringToNumber( value ) : ''
    }

    function onBlur( e ) {
        var value = e.target.value

        var options = {
            maximumFractionDigits: 2,
            currency: currency,
            style: "currency",
            currencyDisplay: "symbol"
        }

        e.target.value = ( value || value === 0 ) ?
            "R$ " + value:
            ''
    }
}



