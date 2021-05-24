<template>
    <div>
        <div v-if="result != 0">
            <div v-if="result == 1" class="alert alert-success col-sm-8">
                Выбранное время доступно
            </div>
            <div v-if="result == 2" class="alert alert-danger col-sm-8">
                Выбранное время занято
            </div>
            <div v-if="result == 3" class="alert alert-danger col-sm-8">
                Проверьте корректность введенных данных
            </div>
        </div>
        <div class="form-inline text">
            <label class="form-check-label" for="check_date">Дата:</label>
            <input
                type="date"
                class="form-control form-control-sm mb-2 mx-2 mr-sm-2"
                name="check_date"
                id="check_date"
                v-model="date"
                @change="result = 0"
                required
            />
            <label class="form-check-label" for="couple">Время:</label>
            <select
                class="form-control form-control-sm mb-2 mx-2 mr-sm-2"
                id="couple"
                name="couple"
                v-model="couple"
                @change="result = 0"
            >
                <option disabled value="0">Выберите</option>
                <option
                    v-for="couple in couples"
                    :key="couple.id"
                    :value="couple.id"
                    >{{ couple.start }} - {{ couple.end }}</option
                >
            </select>
            <label class="form-check-label" for="lane">Номер дорожки:</label>
            <select
                class="form-control form-control-sm mb-2 mx-2 mr-sm-2"
                name="lane"
                id="lane"
                v-model="lane"
                @change="result = 0"
            >
                <option v-for="lane in lanes" :key="lane" :value="lane">{{
                    lane
                }}</option>
            </select>
            <label class="form-check-label" for="places"
                >Количество человек:</label
            >
            <input
                type="number"
                class="form-control form-control-sm mb-2 mx-2 mr-sm-2"
                name="places"
                id="places"
                v-model="places"
                @change="result = 0"
                required
            />
            <button
                type="button"
                v-if="result != 1"
                class="btn btn-info"
                @click="check"
                @change="result = 0"
            >
                Проверить
            </button>
            <button
                type="submit"
                v-if="result == 1"
                class="btn btn-primary"
                @change="result = 0"
            >
                Забронировать
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user", "couples", "lanes", "hall", "route"],

    data: function() {
        return {
            date: null,
            couple: 0,
            lane: 1,
            places: 1,
            result: 0
        };
    },

    methods: {
        check() {
            axios({
                method: "get",
                url: this.route,
                params: {
                    check_date: this.date,
                    couple: this.couple,
                    lane: this.lane,
                    places: this.places,
                    hall: this.hall
                }
            }).then(response => {
                this.result = response.data;
            });
        }
    }
};
</script>
