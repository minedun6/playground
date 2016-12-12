import Vue from 'vue'

import Datatable from './components/DataTable/DataTable.vue'
import Board from './components/Kanban/Board.vue'
import Datachart from './components/Charter/Chart.vue'

require('./filters')

require('./bootstrap');

var app = new Vue({
	el: '#app',
	components: {
		Datatable,
		Board,
		Datachart,
	}
})
