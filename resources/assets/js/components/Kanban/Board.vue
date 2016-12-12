<template>
	<div class="container-fluid sortable-list">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ title }} - {{ projectTasksCount }}</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<board-list :items="tasks[0]" title="Doing"></board-list>
					<board-list :items="tasks[1]" title="To Do"></board-list>
					<board-list :items="tasks[2]" title="Done"></board-list>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Vue from 'vue'
	import boardList from './BoardList.vue' 
	import axios from 'axios' 

	export default {
		props: ['title', 'source'],
		data() {
			return {
				processing: false,
				model: {},
				tasks: {}
			}
		},
		components: {
			boardList
		},
		computed: {
			projectTasksCount() {
				return _.size(this.model.tasks)
			}
		},
		mounted() {
			this.fetchData()
		},
		methods: {
			fetchData() {
				var vm = this
				axios.get(`${this.source}`).then((response) => {
					Vue.set(vm.$data, 'model', response.data.model)
					Vue.set(vm.$data, 'tasks', response.data.sub_model)
				}).catch((response) => {
					console.log(response)
				})
			}
		}
	}
</script>