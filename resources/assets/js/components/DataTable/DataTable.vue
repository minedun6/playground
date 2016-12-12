<template>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ title }}</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2 pull-left">
						<div class="row">
							<div class="col-md-6">
								<select class="form-control" v-model="query.per_page" v-on:change="fetchData()">
										<option
											v-for="per_page_item in per_page_items"
											:value="per_page_item">{{ per_page_item }}
										</option>
									</select>
							</div>
						</div>
					</div>
					<div class="col-md-2 pull-right">
						<div class="input-group">
							<input type="text" class="form-control input-sm" v-model="query.input_query">
							<span class="input-group-btn">
					        		<button class="btn btn-default btn-sm" @click.prevent="search()"><span class="fa fa-search"></span></button>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="loading-message loading-message-boxed" v-if="processing">
							<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Processing ...
						</div>
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th v-for="(column, key) in columns" @click="toggleOrder(column)">
										<span>
												{{ key }}
												<span class="dv-column" v-if="column === query.column">
													<span v-if="query.order === 'asc'">&darr;</span>
										<span v-else="query.order === 'desc'" :class="{ 'disabled' : model.next_page_url!= '' }">&uarr;</span>
										</span>
										</span>
									</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="row in model.data">
									<td v-for="(value, key) in row">{{ value }}</td>
									<td>
										<div class="btn-group">
											<a class="btn btn-default btn-xs" :href="links(row.id)"><i class="fa fa-eye"></i></a>
											<a class="btn btn-default btn-xs" :href="links(row.id)"><i class="fa fa-eye"></i></a>
											<a class="btn btn-default btn-xs" :href="links(row.id)"><i class="fa fa-eye"></i></a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 pull-left">
						<span>Displaying {{ model.from }} - {{ model.to }} of {{ model.total }} rows</span>
					</div>
					<div class="col-sm-2 pull-right">
						<div class="row">
							<div class="col-md-8 col-md-offset-4">
								<div class="input-group">
									<span class="input-group-btn">
								        	<button
								        		class="btn btn-default btn-sm"
								        		@click.prevent="prev()"
							        			:class="{ 'disabled' : !model.prev_page_url }">
								        			<span class="fa fa-angle-left"></span>
									</button>
									</span>
									<input type="text" class="form-control input-sm" v-model="model.current_page" disabled>
									<span class="input-group-btn">
								        	<button
								        		class="btn btn-default btn-sm"
								        		@click.prevent="next()"
								        		:class="{ 'disabled' : !model.next_page_url }">
								        			<span class="fa fa-angle-right"></span>
									</button>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'

export default {
	props: ['source', 'title'],
	data() {
		return {
			processing: false,
			model: {},
			columns: {},
			per_page_items: ['5', '10', '20'],
			query: {
				page: 1,
				column: 'id',
				order: 'asc',
				per_page: 5,
				current_page: 1,
				input_query: '',
			},
		}
	},
	mounted() {
		this.fetchData()
	},
	methods: {
		search() {
			this.query.page = 1
			this.fetchData()
		},
		toggleOrder(column) {
			if (column === this.query.column) {
				if (this.query.order === 'desc') {
					this.query.order = 'asc'
				} else {
					this.query.order = 'desc'
				}
			} else {
				this.query.column = column
				this.query.order = 'asc'
			}
			this.fetchData()
		},
		links(id) {
			return this.source + '/' + id
		},
		prev() {
			if (this.model.prev_page_url) {
				this.query.page--
					this.fetchData()
			}
		},
		next() {
			if (this.model.next_page_url) {
				this.query.page++
					this.fetchData()
			}
		},
		fetchData() {
			var vm = this
			this.processing = true
			axios.get(`${this.source}?column=${this.query.column}&order=${this.query.order}&page=${this.query.page}&per_page=${this.query.per_page}&input_query=${this.query.input_query}`)
				.then((response) => {
					Vue.set(vm.$data, 'model', response.data.model)
					Vue.set(vm.$data, 'columns', response.data.columns)
					this.processing = false
				}).catch((response) => {
					console.log(response)
				})
		}
	}
}
</script>

<style scoped>
[class*="col-"] {
	margin-bottom: 15px;
}

.loading-message {
	display: inline-block;
	min-width: 125px;
	margin-left: -60px;
	padding: 10px;
	margin: 0 auto;
	color: #000 !important;
	font-size: 13px;
	font-weight: 400;
	text-align: center;
	vertical-align: middle;
	-webkit-font-smoothing: antialiased;
	transform: translate(-50%, -50%);
	top: 50%;
	left: 50%;
	position: absolute;
}

.loading-message.loading-message-boxed {
	border: 1px solid #ddd;
	background-color: #eee;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-ms-border-radius: 4px;
	-o-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1);
	-moz-box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1);
	box-shadow: 0 1px 8px rgba(0, 0, 0, 0.1);
}

.loading-message>span {
	line-height: 20px;
	vertical-align: middle;
}


/*table{
	table-layout:fixed;
}*/
</style>
