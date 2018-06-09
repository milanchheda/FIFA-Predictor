
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/autocomplete.js';

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

$(document).on('click', '.saveLockTimes', function(){
	axios.post('/admin/set-lock-times', {
        id: $(this).data('match-id'),
        time: $(this).parents("tr:first").find('.selectedLockTime').val()
    })
    .then(function (response) {
    	alert('Saved Successfully.');
		location.reload();
    });
});


$(document).on('click', '.savePredictionLockTimes', function(){
    axios.post('/admin/save-prediction-lock-times', {
        id: $(this).data('prediction-id'),
        selectedPredictionLockTime: $(this).parents("tr:first").find('.selectedPredictionLockTime').val()
    })
    .then(function (response) {
        alert('Saved Successfully.');
        location.reload();
    });
});

$(document).on('click', '.savePredictionWinner', function(){
    var selectedId = $(this).parents("tr:first").find('.predictionWinnerId').val();
    if($(this).data('prediction-type') == 'players')
        selectedId = $('#userPredictedPlayerId').val();
	axios.post('/admin/predictions', {
        id: $(this).data('prediction-id'),
        predictionWinnerId: selectedId
    })
    .then(function (response) {
    	alert('Saved Successfully.');
		location.reload();
    });
});

$(document).on('click', '.saveUserPrediction', function(){
    var selectedId = $(this).parents("tr:first").find('.userPredictedTeamId').val();
    if($(this).data('prediction-type') == 'players')
        selectedId = $('#userPredictedPlayerId').val();
    if(selectedId != '') {
        axios.post('predictions', {
            id: $(this).data('prediction-id'),
            userPredictedTeamId: selectedId
        })
        .then(function (response) {
            alert('Saved Successfully.');
            location.reload();
        });
    } else {
        alert("Please select some value.");
    }
});

$(document).on('click', '.saveUserSelectedWinningTeam', function(){
	axios.post('fixtures', {
        winner: false,
        id: $(this).data('match-id'),
        userPredictedTeamId: $(this).parents("tr:first").find('.UserSelectedWinningTeamId').val()
    })
    .then(function (response) {
    	alert(response.data.message);
		// location.reload();
    });
});

$(document).on('click', '.saveMatchWinnerId', function(){
    axios.post('fixtures', {
        winner: true,
        id: $(this).data('match-id'),
        userPredictedTeamId: $(this).parents("tr:first").find('.matchWinnerId').val()
    })
    .then(function (response) {
        alert(response.data.message);
        location.reload();
    });
});

$(".players").autocomplete({
    source: "get-players",
    minLength: 3,
    appendTo: '#players-autocomplete-container',
    select: function( event, ui ) {
        $('#userPredictedPlayerId').val(ui.item.id);
    }
});
