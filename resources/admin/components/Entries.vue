<script>
    export default {
        data: function() {
            return {
                entriesSite: [],
                setEntries: null,
                setLengthEntries: null,

                //data for list of entries
                showItems: "10",
                paginatePage: 1,
                keySearch: 'buildings.name',
                inputSearch: null,
                ascending: true,
                orderBy: 'buildings.name',

                detailsEntry: {
                    id: null,
                    building: '',
                    entry: '',
                    city_id: '',
                    street: '',
                    nrFloor: '',
                    nrApartaments: '',
                },
            }
        },
        beforeCreate() {},

        created() {
            this.$store.watch(
                (state) => {
                    return this.$store.getters.getShowItem
                }, (val) => {
                    this.showItems = this.$store.getters.getShowItem;
                    this.Entries();
                });

            this.$store.watch(
                (state) => {
                    return this.$store.getters.getPaginatePage
                }, (val) => {
                    this.paginatePage = this.$store.getters.getPaginatePage;
                    this.Entries();
                });
        },
        mounted() {
            this.Entries();
        },

        computed: {
            objEntries: function() {
                return this.setEntries;
            },
        },

        watch: {
            keySearch: function() {
                this.inputSearch = null;
                this.paginatePage = 1;
                this.Entries();
            },
            showItems: function() {
                this.paginatePage = 1;
                this.Entries();
            },

        },

        methods: {
            Entries: function() {
                this.entriesSite = {
                    limit: this.showItems,
                    page: this.paginatePage,
                    relation: this.keySearch,
                    value: this.inputSearch,
                    asce: this.ascending,
                    orderBy: this.orderBy,
                };

                this.$http.post(`/getEntries`, this.entriesSite)
                    .then(response => {
                        this.setEntries = response.data.entries;
                        this.setLengthEntries = response.data.count;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },

            addEntry:function() {
                console.log('addForm');
                // router.go('/entry');
                // route.push('entry');
                // routes.push({ path: 'home' })

                // this.$store.commit('entry/setEntrySection', {
                //     address:true,
                //     accessPointElevator:false,
                //     addEditAccessPoint:false,
                // });
            },

            editEntry: function(paramId) {
                console.log(paramId);

                // this.$store.commit('entry/setEntrySection', {
                //     address:true,
                //     accessPointElevator:false,
                //     addEditAccessPoint:true,
                // });
            },

            deleteEntry: function(paramId) {
                console.log(paramId);
                this.$http.delete(`/deleteEntry/`+paramId)
                .then(response => {
                    console.log('U fshi me sukses');
                    this.Entries();
                })
                .catch(e => {
                    console.log(e.respone);
                });
            },

            Sort: function(orderBy, ascending) {
                if (this.orderBy == orderBy) {

                    if (this.ascending != ascending) {
                        this.orderBy = orderBy;
                        this.ascending == ascending;
                    } else {
                        this.orderBy = orderBy;
                        this.ascending = !ascending;
                    }

                } else if (this.orderBy != orderBy) {

                    this.orderBy = orderBy;
                }
                this.Buildings();
            },
        },
    }
</script>

<template src="./templates/entries.html">
</template>

<style>
</style>