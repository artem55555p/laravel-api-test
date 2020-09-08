<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Форма отправки email</div>
                    <div class="panel-body">
                        <form>
                            <div class="form-row align-items-center">
                                <div v-if="status">
                                    <div class="alert alert-success">
                                        Ваше сообщение успешно отправлено
                                    </div>
                                </div>
                                <div v-if="errors.length">
                                    <b>Пожалуйста исправьте указанные ошибки:</b>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li v-for="error in errors">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Имя</label>
                                    <input v-model="fields.name" name="name" type="text" class="form-control" id="inputName">
                                </div>
                                <div class="form-group">
                                    <label for="textareaMessage">Напишите сообщение</label>
                                    <textarea v-model="fields.message" name="message" class="form-control" id="textareaMessage" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" @click.prevent="sendHandler">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fields: {
                    name: null,
                    message: null,
                },
                errors: [],
                status: null,
            };
        },
        mounted() {

        },
        methods: {
            sendHandler () {
                this.errors = []
                this.status = null

                if (!this.fields.name) {
                    this.errors.push('Требуется указать имя.')
                }
                if (!this.fields.message) {
                    this.errors.push('Требуется указать сообщение.')
                }

                if (this.fields.name && this.fields.message) {
                    axios.post('/api/v1/feedback', this.fields).then(response => {
                        this.fields = {
                            name: null,
                            message: null,
                        };
                        this.status = response.data
                    }).catch(error => {
                        alert("Не удалось отправить данные")
                    });
                }

            }
        }
    }
</script>
