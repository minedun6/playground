<template>
    <div>
    	<div class="col-md-4">
	        <div class="panel panel-default card-list">
	            <div class="panel-heading">
	                <h3 class="panel-title pull-left">{{ title }}</h3>
	                <span class=" pull-right">
	                    <span class="bdage text-centered">{{ listTasksCount }}</span>
	                </span>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body">
	                <ul class="list-group items scroller">
						<board-card v-for="task in items" :task="task"></board-card>
	                </ul>
	            </div>
	        </div>
	    </div>
    </div>
</template>

<script>
	import boardCard from './BoardCard.vue'

	export default {
		components: {
			boardCard
		},
		props: ['items', 'title'],
		data() {
			return {
                
			}
		},
        computed: {
			listTasksCount() {
				return _.size(this.items)
			}
		},
		mounted() {
			$('.scroller').slimScroll({height: '300px', railVisible: true});

			$('.list-group').sortable({
	            connectWith: '.list-group',
	            container: '.container',
	            helper: 'clone',
	            revert: 'invalid',
	            forceHelperSize: true,
	            placeholder: {
	                element: function(clone, ui) {
	                    return $('<li class="list-group-item ui-state-highligh"></li>');
	                },
	                update: function() {
	                    return;
	                }
	            },start: function(e, ui){
        			ui.placeholder.height(ui.item.height());
   				}
	        }).disableSelection();
		}
	}
</script>

<style>
	.ui-state-highligh{
        margin: 2px 0;
        padding: 18px;
        border: 2px dashed #eee !important;
    }
    ul.list-group{
    	padding: 2px;
    }
</style>
