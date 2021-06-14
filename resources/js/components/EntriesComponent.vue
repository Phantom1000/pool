<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-2 titles">{{ title }}</div>
                <!--filter-->
                <div class="col-sm-10 d-flex" v-if="user">
                    <div class="col-sm-2">
                        <form
                            class="form-inline my-2 my-lg-0"
                            method="GET"
                            @submit.prevent="loadEntries"
                        >
                            <label for="hall_id" class="text mr-2">Зал:</label>
                            <select
                                class="form-control form-control"
                                id="hall_id"
                                v-model="hall.id"
                                @change="loadEntries"
                            >
                                <option disabled value="0">Выберите</option>
                                <option
                                    v-for="(item, index) in halls"
                                    :key="index"
                                    :value="item.id"
                                    >{{ item.name }}</option
                                >
                            </select>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <form
                            method="GET"
                            class="form-inline ml-4"
                            @submit.prevent="loadEntries"
                        >
                            <div class="form-group">
                                <button
                                    class="btn btn-primary mr-2"
                                    type="button"
                                    @click="show = !show"
                                >
                                    {{
                                        show
                                            ? "Скрыть фильтр"
                                            : "Показать фильтр"
                                    }}
                                </button>
                            </div>
                            <div v-if="show">
                                <div class="form-group">
                                    <div class="text mr-2">
                                        Номер дорожки:
                                    </div>
                                    <div
                                        v-for="(lane, index) in hall.lanes"
                                        :key="index"
                                        class="form-check-inline"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            :value="lane"
                                            :id="`lane${lane}`"
                                            v-model="lanes"
                                        />
                                        <label
                                            class="form-check-label text"
                                            :for="`lane${lane}`"
                                        >
                                            {{ lane }}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="text mr-2" for="stime">
                                        С
                                    </label>
                                    <input
                                        class="form-control"
                                        type="time"
                                        id="stime"
                                        v-model="stime"
                                    />
                                    <label class="text mx-2" for="stime"
                                        >по</label
                                    >
                                    <input
                                        class="form-control"
                                        type="time"
                                        id="etime"
                                        v-model="etime"
                                    />
                                </div>
                                <div class="form-group mt-2">
                                    <label class="text mr-2" for="date"
                                        >Дата:</label
                                    >
                                    <input
                                        class="form-control"
                                        type="date"
                                        v-model="date"
                                        id="date"
                                    />
                                </div>
                                <div class="form-group mt-2">
                                    <div class="text mr-2">Мест:</div>
                                    <label class="text mr-2" for="splace">
                                        С
                                    </label>
                                    <input
                                        class="form-control col-sm-2"
                                        type="number"
                                        id="splace"
                                        v-model="splace"
                                    />
                                    <label class="text mx-2" for="splace"
                                        >по</label
                                    >
                                    <input
                                        class="form-control col-sm-2"
                                        type="number"
                                        id="eplace"
                                        v-model="eplace"
                                    />
                                </div>
                                <div class="form-group mt-2">
                                    <button
                                        class="btn btn-success ml-2 mt-2"
                                        type="submit"
                                    >
                                        Применить
                                    </button>
                                    <button
                                        class="btn btn-info ml-2 mt-2"
                                        @click="clear"
                                    >
                                        Сбросить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 form-inline">
                        <input
                            class="form-control mr-sm-2"
                            v-model="uuid"
                            type="text"
                            placeholder="Введите uuid"
                            aria-label="Search"
                        />
                        <button
                            class="btn btn-outline-info my-2 my-sm-0"
                            @click="loadEntries"
                        >
                            Найти
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center" v-if="user">
                <table
                    class="table table-striped table-dark table-bordered mt-3 col-sm-9"
                >
                    <thead>
                        <tr v-if="!loading">
                            <td colspan="9">
                                <h1 class="text-center">
                                    Загрузка...
                                </h1>
                            </td>
                        </tr>
                        <tr>
                            <th>Идентификатор</th>
                            <th>Пользователь</th>
                            <th>Зал</th>
                            <th>№ дорожки</th>
                            <th>Мест</th>
                            <th>Время</th>
                            <th>Дата</th>
                            <th>Состояние</th>
                            <th class="text-center">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(entry, index) in entries" :key="index">
                            <td class="text-center" scope="row">
                                <a
                                    :href="`/storage/qrcodes/${entry.uuid}.pdf`"
                                    class="link"
                                    >{{ entry.uuid }}</a
                                >
                            </td>
                            <td class="text-center" scope="row">
                                {{ entry.user.username }}
                            </td>
                            <td class="text-center" scope="row">
                                {{ entry.couple.schedule.hall.name }}
                            </td>
                            <td class="text-center" scope="row">
                                {{ entry.lane }}
                            </td>
                            <td class="text-center" scope="row">
                                {{ entry.places }}
                            </td>
                            <td class="text-center" scope="row">
                                {{ entry.start }} -
                                {{ entry.end }}
                            </td>
                            <td class="text-center" scope="row">
                                {{ entry.date }}
                            </td>
                            <td class="text-center" scope="row">
                                <span v-if="entry.state === 0"
                                    >Забронировано</span
                                >
                                <span v-else-if="entry.state === 1"
                                    >Оплачено</span
                                >
                                <span v-else-if="entry.state === 2"
                                    >Посещено</span
                                >
                                <span v-else>Ошибка</span>
                            </td>
                            <td>
                                <div class="row justify-content-center">
                                    <button
                                        v-if="canDelete(entry)"
                                        type="button"
                                        class="btn btn-danger m-1"
                                        @click="cancel(entry)"
                                    >
                                        Отменить
                                    </button>
                                    <button
                                        v-if="checkRole('seller')"
                                        type="submit"
                                        class="btn btn-success m-1"
                                        @click="pay(entry)"
                                    >
                                        Продать
                                    </button>
                                    <button
                                        v-if="checkRole('controller')"
                                        type="submit"
                                        class="btn btn-success m-1"
                                        @click="pass(entry)"
                                    >
                                        Пропустить
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="entries.length === 0">
                            <td colspan="9">
                                <h1 class="text-center">
                                    Записей для обработки нет
                                </h1>
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
    props: ["user", "csrf_token", "roles", "is_profile"],
    data() {
        return {
            hall: Object,
            lanes: [],
            show: false,
            stime: "",
            etime: "",
            date: "",
            splace: "",
            eplace: "",
            halls: [],
            entries: [],
            title: "",
            uuid: "",
            loading: true
        };
    },
    created() {
        this.loadEntries();
    },
    mounted() {
        if (!this.is_profile) {
            Echo.private(`App.Models.User.${this.user.id}`).notification(
                notification => {
                    this.loadEntries(true);
                    //console.log('test');
                }
            );
        }

        /*Echo.channel("change").listen("ChangeEntryEvent", e =>
            this.loadEntries()
        );*/
    },
    methods: {
        canDelete(entry) {
            let filterRoles = this.roles.filter(function(role) {
                return (
                    role === "admin" ||
                    role === "controller" ||
                    role === "seller"
                );
            });
            return (
                filterRoles.length > 0 ||
                (this.user.id === entry.user.id && entry.state === 0)
            );
        },

        checkRole(slug) {
            let filterRoles = this.roles.filter(function(role) {
                return role === slug;
            });
            return filterRoles.length > 0;
        },

        pay(entry) {
            this.loading = false;
            axios.put(`/entries/pay/${entry.id}`).then(response => {
                this.loadEntries();
            });
        },

        pass(entry) {
            this.loading = false;
            axios.put(`/entries/pass/${entry.id}`).then(response => {
                this.loadEntries();
            });
        },

        cancel(entry) {
            this.loading = false;
            axios.delete(`/entries/${entry.id}`).then(response => {
                this.loadEntries();
            });
        },

        loadEntries(flag = false) {
            this.loading = flag;
            if (this.is_profile) {
                axios
                    .get("/profile/entries", {
                        params: {
                            lanes: this.lanes,
                            stime: this.stime,
                            etime: this.etime,
                            date: this.date,
                            splace: this.splace,
                            eplace: this.eplace,
                            hall_id: this.hall.id,
                            uuid: this.uuid
                        }
                    })
                    .then(response => {
                        this.loading = true;
                        this.halls = response.data.halls;
                        this.hall = response.data.hall
                            ? response.data.hall
                            : { id: 0, lanes: 0 };
                        this.entries = response.data.entries;
                        this.title = "";
                    });
            } else {
                axios
                    .get("/entries/my", {
                        params: {
                            lanes: this.lanes,
                            stime: this.stime,
                            etime: this.etime,
                            date: this.date,
                            splace: this.splace,
                            eplace: this.eplace,
                            hall_id: this.hall.id,
                            uuid: this.uuid
                        }
                    })
                    .then(response => {
                        this.loading = true;
                        this.halls = response.data.halls;
                        this.hall = response.data.hall
                            ? response.data.hall
                            : { id: 0, lanes: 0 };
                        this.entries = response.data.entries;
                        this.title = response.data.title;
                    });
            }
        },

        clear() {
            this.lanes = [];
            this.stime = "";
            this.etime = "";
            this.date = "";
            this.splace = "";
            this.eplace = "";
            this.hall.id = 0;
            this.loadEntries();
        }
    }
};
</script>
