<template>
	<li class="list-group-item">
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object img-circle" src="http://placehold.it/40x40" alt="Image">
            </a>
            <div class="media-body">
                <h5 class="media-heading"><strong>{{ task.title }}</strong></h5>
                <p> {{ task.description }} </p>
            </div>
        </div>
    </li>
</template>

<script>
	export default {
        props: ['task']		
	}
</script>