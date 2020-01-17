<!DOCTYPE html>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Сотрудники
                        <button v-on:click="refresh()">Отменить изменения</button>
                    </div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <td>Имя сотрудника</td>
                                <td>Дата рождения</td>
                                <td>Должность</td>
                            </tr>
                            <tr v-for="(employee, index) in employees" >
                                <td><input v-model="employees[index].name"></td>
                                <td><input v-model="employees[index].birthday"></td>
                                <td><input v-model="employees[index].position"></td>
                                <td><button v-on:click="destroy(employee.id)">Удалить</button></td>
                                <td><button v-on:click="update(index)">Записать</button></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        Добавить нового сотрудника
                        <table>
                            <tr>
                                <td><input v-model="newEpmployee.name" placeholder="имя сотрудника"></td>
                                <td><input v-model="newEpmployee.birthday" placeholder="дата рождения"></td>
                                <td><input v-model="newEpmployee.position" placeholder="должнось"></td>
                                <td><button v-on:click="create()">Добавить</button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                employees: [],
                newEpmployee: {
                    name: "",
                    birthday: "",
                    position:"",
                }
            }
        },

        mounted() {
            this.refresh();
        },

        methods : {
            /*
            Метод для обновления данных на странице без перезагрузки
            */
            refresh(){
                axios.get('\employees')
                .then(response => {
                    this.employees = response.data.employees;
                })
                .catch(error => {
                    window.alert(error);
                })
            },

            /*
            Метод удаления записи из таблицы
            id - индентификатор записи в базе данных
            */
            destroy(id){
                if(id !== null && typeof(id) !== 'undefined') {
                    axios.delete('\employees\\'+id).then(response => {
                        this.refresh();
                    })
                } else throw "Id is undefined or null"
            },

            /*
            Метод создания новой записи. 
            Использует поле newEpmployee данных компонента в качестве входных данных. 
            */
            create(){
                //Проверка на пустые строки
                if(this.newEpmployee.name != "" && 
                    this.newEpmployee.birthday != "" &&
                    this.newEpmployee.position != ""){
                    axios.post('\employees',{
                        name: this.newEpmployee.name,
                        birthday: this.newEpmployee.birthday,
                        position: this.newEpmployee.position
                    })
                    .then(response => {
                        this.refresh();
                    })
                    //Ловим и выводим ошибки валидации
                    .catch(error => {
                        for (var value in error.response.data.errors){
                            window.alert(error.response.data.errors[value]);
                        }
                    })
                } else window.alert('Some of the strings are empty');
            },

            /*
            Метод обновления существующей записи. 
            id - индентификатор записи в локальном массиве данных
            */
            update(id){
                if(id !== null && typeof(id) !== 'undefined') {
                //Проверка на пустые строки
                    if(this.employees[id].name != "" && 
                    this.employees[id].birthday != "" &&
                    this.employees[id].position != ""){
                        axios.post('\employees\\'+this.employees[id].id,{
                            name: this.employees[id].name,
                            birthday: this.employees[id].birthday,
                            position: this.employees[id].position
                        })
                        .then(response => {
                            this.refresh();
                        })
                        //Ловим и выводим ошибки валидации
                        .catch(error => {
                            for (var value in error.response.data.errors){
                                window.alert(error.response.data.errors[value]);
                            }
                        })
                    } else window.alert('Some of the strings are empty');
                } else throw "Id is undefined or null"
            }
        }
    }
</script>
