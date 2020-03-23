<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'articleCreate'}" class="btn btn-success">Create new company</router-link>
        </div>

        <div class="panel panel-default" v-show="articles.length">
            <div class="panel-heading">Companies list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Тип</th>
                        <th>Автор</th>
                        <th>Додано</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="article, index in articles">
                        <td>{{ article.title }}</td>
                        <td>{{ article.type }}</td>
                        <td>{{ article.author_id }}</td>
                        <td>{{ article.created_at }}</td>
                        <td>
                            <router-link :to="{name: 'editCompany', params: {id: article.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(article.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                articles: []
            }
        },
        mounted() {
            let app = this
            axios.post('/article/all').then(function (resp) {
                app.articles = resp.data
            }).catch(function (resp) {
                alert("Could not load companies")
            })
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    let app = this
                    axios.post('/article/delete', {id})
                        .then(function (resp) {
                            app.articles.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete company");
                        });
                }
            }
        }
    }
</script>