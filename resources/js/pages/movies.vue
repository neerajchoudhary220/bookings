<template>
    <div class="row mt-2">
        <div class="col-12 text-center bg-info text-white p-3">
            <h3>Movies</h3>
        </div>
        <div v-if="movie_list">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3" v-for="movie in movie_list" :key="movie.id">
                    <div class="card m-2 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                        <img :src="movie.img" class="card-img-top" alt="Movie Poster" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center p-3">
                            <h5 class="card-title"><strong>{{ movie.title }}</strong></h5>
                            <div class="d-flex justify-content-center">
                                <a :href="movie.download_link" class="btn btn-primary mt-3 w-75">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="paginators" class="text-center mb-3">
        <button v-for="page in paginators" :disabled="page.url === null" 
        class="btn mx-1 mb-2" 
        :class="{'btn-info': page.active, 'btn-dark': !page.active}" 
        :value="page.url" @click="changePage(page.url)">
            {{ page.label }}
        </button>
    </div>
</template>


<script>
import { onMounted, ref } from 'vue'
import axios from 'axios';
export default {
    name: 'Movies',
    setup() {
        const movie_list = ref()
        const paginators = ref()
        const link = ref(`https://monty.loca.lt/api/list`)

        const fetchMovieList = () => {
            axios.get(link.value).then((response) => {
                movie_list.value = response.data.data
                paginators.value = response.data.meta.links
            }).catch((error) => {
                console.log(error)
            })

        }
        const changePage = (url) => {
            link.value = url
            fetchMovieList()  // Fetch movie data when changing page
        }

        onMounted(() => {
            fetchMovieList()  // Fetch movie data when the component is mounted
        })

        return { movie_list, paginators,changePage }
    }
}
</script>
