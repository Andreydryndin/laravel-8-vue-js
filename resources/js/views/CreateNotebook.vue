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
                    <img :src="photo" alt="">
                    <br>
                    <input class="uk-input" @change="onFileChange" type="file" placeholder="Photo">
                </div>

                <button class="uk-button uk-button-primary" @click.prevent="store">
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
                company_name: "",
                telephone: "",
                email: "",
                birthday: "",
                photo: "",
            },
            photo: '',
            CSRF_TOKEN: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            loading: false,
            error: false
        }),
        methods: {
            onFileChange(e) {
                let fileList = Array.prototype.slice.call(e.target.files);

                if (!fileList[0].type.match("image.*")) {
                    return;
                }

                this.form.photo = fileList[0];

                let data = new FormData();
                data.append('file', e.target.files[0]);
                data.append('_token',this.CSRF_TOKEN);
                data.append('enctype','multipart/form-data');

                const config = {
                    headers: {
                        'content-type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
                    }
                };

                axios.post('/api/v1/upload_screen/',
                    data, config
                ).then(response => {
                    if(response.data.success){
                        this.form.photo = response.data.filePath;
                        this.photo = '../images/' + response.data.filePath;
                        console.log(that.form.photo);
                    }
                }).catch(function () {

                });
            },
            store() {
                this.loading = true;
                axios.post('/api/v1/notebook', this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                    .then(res => {
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
