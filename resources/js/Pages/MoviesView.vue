<script setup>
import { ref, onMounted } from "vue";
let movies = ref([]);

const fetchMovies = async () => {
    const response = await fetch("/api/v1/movies");
    const data = await response.json();
    movies.value = data;
};

onMounted(() => {
    fetchMovies();
});

</script>
<template>
    <div class="container my-5">
        <div class="text-center" v-if="movies.length === 0">
            <h3>No movies to show</h3>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" v-else>
            <div class="col" v-for="movie in movies" :key="movie.id">
                <div class="card shadow-sm">
                    <img :src="movie.poster_path" class="card-img-top" :alt="movie.title + ' poster'">
                    <div class="card-body">
                        <h5 class="card-title">{{ movie.title }}</h5>
                        <p class="card-text">{{ movie.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

