<template>
    <div class="uk-card uk-card-body">
        <spin v-if="loading"></spin>
        <div v-else-if="!loading && !not_found">
            <h1>{{ notebook.name }} <span class="uk-badge"> {{ notebook.created_at }}</span></h1>
            <p class="uk-text-lead"> {{ notebook.company_name }} </p>
            <p class="uk-text-lead"> {{ notebook.telephone }} </p>
            <p class="uk-text-lead"> {{ notebook.email }} </p>
            <p class="uk-text-lead"> {{ notebook.birthday }} </p>
            <div class="img">
                <img  :src="'../images/' + notebook.photo">
            </div>
        </div>
        <div uk-alert v-if="not_found">
            <a class="uk-alert-close" uk-close></a>
            <h3>404 пост не найден</h3>
        </div>
    </div>
</template>

<script>
    import Spin from "../components/Spin";
    import axios from "axios";

    export default {
        comments: {
            Spin
        },
        data: () => ({
            loading: true,
            notebook: [],
            not_found: false
        }),
        mounted() {
            this.loadNotebook(this.$route.params.id);
        },
        methods: {
            loadNotebook(id) {
                axios.get('/api/v1/notebook/' + id)
                    .then(res => {
                        this.notebook = res.data;
                        setTimeout(()=>{
                            this.loading = false;
                            },500);
                    })
                    .catch(err => {
                        this.not_found = true;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
