<template>
    <form action="" method="post" @submit.prevent="saveMovie" id="movieForm">
        <div class="form-group mb-10">
            <label class="form-label" for="title" id="m_title">Title</label>
            <input type="text" class="form-control" id="m_title" v-model="movie.title">
        </div>
        <div class="form-group mb-10">
            <label class="form-label" for="description" id="m_descript">Description</label>
            <textarea name="movie-description" id="m_descript" class="form-control"
                v-model="movie.description"></textarea>
        </div>
        <div class="form-group mb-10">
            <label class="form-label" for="poster" id="m_poster">Poster</label>
            <input class="form-control" type="file" name="movie-poster" id="m_poster" @change="onFileChange">
        </div>
        <button class="btn btn-primary mt-auto" type="submit">Save</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            movie: new FormData()
        }
    },
    methods: {
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length) {
                return;
            }
            this.movie.append('poster', files[0]);
        },
        methods: {
            saveMovie() {
                let movieForm = document.getElementById('movieForm');
                let formData = new FormData(movieForm);

                fetch("/api/v1/movies", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                    }
                })

                .then(response => response.json())
                .then(data => {console.log(data);})
                .catch((error) => {console.error('Error:', error);})
                
                // const data = new FormData();
                // data.append('title', this.movie.title);
                // data.append('description', this.movie.description);
                // data.append('poster', this.movie.poster);

                // const xhr = new XMLHttpRequest();
                // xhr.open('POST', '/api/v1/movies', true);
                // xhr.onload = function () {
                //     if (this.status == 200) {
                //         console.log(this.response);
                //     } else {
                //         console.log(this.response);
                //     }
                // };
                // xhr.send(data);
            },
        }
    }
}
</script>
