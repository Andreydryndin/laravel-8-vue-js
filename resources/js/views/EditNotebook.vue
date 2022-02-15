<template>
    <div>
        <div class="uk-alert-danger" uk-alert v-if="error">
            <a class="uk-alert-close" uk-close></a>
            <p>Проверьте правильность введенный полей</p>
        </div>
        <form style="margin-bottom: 20px;">
            <fieldset class="uk-fieldset">

                <div class="uk-margin">
                    <input class="uk-input" v-model="form.name" type="text" placeholder="name">
                </div>

                <div class="uk-margin">
                    <input class="uk-input" v-model="form.company_name" type="text" placeholder="company name">
                </div>

                <div class="uk-margin">
                    <input class="uk-input" v-model="form.telephone" type="text" placeholder="telephone">
                </div>

                <div class="uk-margin">
                    <input class="uk-input" v-model="form.email" type="text" placeholder="email">
                </div>

                <div class="uk-margin">
                    <input class="uk-input" v-model="form.birthday" type="text" placeholder="birthday">
                </div>


                <div class="uk-margin">
                    <img class="uk-input" :src="form.photo">
                    <input class="uk-input" @change="onFileChange" type="file" placeholder="Photo">
                </div>


                <button class="uk-button uk-button-primary" @click.prevent="update">
                    <div uk-spinner v-if="loading"></div>
                    <span v-else>Сохранить</span>
                </button>
            </fieldset>

        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        components: {},
        data: () => ({
            form: {
                name: "",
                id: "",
                company_name: "",
                telephone: "",
                email: "",
                birthday: "",
                photo: "",
            },
            loading: false,
            error: false
        }),
        mounted() {
            this.loadNotebook(this.$route.params.id);
        },
        methods: {
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.form.photo = files;
            },
            loadNotebook(id) {
                axios.get('/api/v1/notebook/' + id)
                    .then(res => {
                        this.form = res.data;
                        setTimeout(()=>{
                            this.loading = false;
                        },500);
                    })
                    .catch(err => {
                        this.not_found = true;
                    })
            },
            update() {
                this.loading = true;
                console.log(this.form);
                axios.post('/api/v1/notebook/' + this.form.id, this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                    .then(res => {
                        console.log(res);
                        if (res.data.status) {
                            this.$router.push('/notebook/' + res.data.notebook.id);
                        } else {
                            setTimeout(() => {
                                this.loading = false;
                            }, 300);
                            this.error = true;
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
