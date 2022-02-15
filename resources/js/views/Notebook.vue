<template>
    <div class="uk-card uk-card-default">
        <spin v-if="loading"></spin>
        <div style="display: flex; flex-wrap: wrap;" v-else>

            <show
                v-for="notebook in notebooks"
                :key="notebook.id" :name="notebook.name"
                :id="notebook.id"
                :company_name="notebook.company_name"
                :telephone="notebook.telephone"
                :email="notebook.email"
                :birthday="notebook.birthday"
                :photo="notebook.photo"
                :date="notebook.created_at"
            >
            </show>
        </div>
    </div>
</template>

<script>
    import Spin from "../components/Spin";
    import axios from 'axios';
    import Show from "../components/Notebook/Show";

    export default {
        components: {
            Spin,
            Show
        },
        data: () => ({
            loading: true,
            notebooks: []
        }),
        mounted() {
            this.loadNotebook()
            this.$root.$on('update:loadNotebook', () => this.loadNotebook());
        },
        methods: {
            loadNotebook() {
                axios.get('/api/v1/notebook')
                    .then(res => {
                        this.notebooks = res.data;
                        setTimeout(() => {
                            this.loading = false;
                        }, 500)
                    })
            }
        }
    }


</script>

<style scoped>

</style>
