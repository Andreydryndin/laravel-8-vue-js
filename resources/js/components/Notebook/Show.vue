<template>
    <div class="uk-card uk-card-body">
        <h3 class="uk-card-title">{{name}}</h3>
        <p class="uk-text-truncate">
            <img :src="'/images/' + photo" alt="">
        </p>
        <p class="uk-text-truncate">{{ company_name }}</p>
        <p class="uk-text-truncate">{{ telephone }}</p>
        <p class="uk-text-truncate">{{ email }}</p>
        <p class="uk-text-truncate">{{ birthday }}</p>

        <div class="uk-child-width-auto uk-flex-middle" uk-grid>
            <div>
                <ul class="uk-iconnav uk-flex-right">
                    <li><a href="#" uk-icon="icon: heart"></a></li>
                    <li><a href="#" uk-icon="icon: comment"></a></li>
                    <li><a href="#" uk-icon="icon: star"></a></li>
                </ul>
            </div>
        </div>

        <p class="uk-text-small uk-text-muted">{{ date }}</p>

        <div>
            <router-link :to="'notebook/' + id">Show</router-link>
            <router-link :to="'notebook/edit/' + id">Edit</router-link>
            <a @click.prevent="deleteNotebook(id)">Delete</a>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        props:{
            id:{
                type: Number,
                default: "NULL"
            },
            name:{
                type: String,
                default: "NULL"
            },
            company_name:{
                type: String,
                default: "NULL"
            },
            telephone:{
                type: String,
                default: "NULL"
            },
            email:{
                type: String,
                default: "NULL"
            },
            birthday:{
                type: String,
                default: "NULL"
            },
            photo:{
                type: String,
                default: "NULL"
            },
            date: {
                type: String,
                default: "NULL"
            }
        },
        methods: {
            deleteNotebook(id) {
                console.log(id);
                axios.delete('/api/v1/notebook/' + id)
                    .then(res => {
                        this.notebook = res.data;
                        setTimeout(()=>{
                            this.loading = false;

                        },500);
                        this.$root.$emit('update:loadNotebook');
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
