<template>
    <div class="users-style">
        
        <div class="table-style" >
            <input class="input" type="text" v-model="search" placeholder="Search..."
                  @input="resetPagination()" style="width: 250px;">
                <div class="control">
                <div class="select">
                    <select v-model="length" @change="resetPagination()">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
          
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th v-for="column in columns" :key="column.name">
                        {{column.label}}
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="trip in paginatedTrips" :key="trip.id">
                    <td>{{trip.name}}</td>
                    <td>{{trip.owner}}</td>
                    <td class="has-text-right">
                        <form method="post" :action="'/trips/' + trip.id + '/copy'" style="float:left">
                           <input type="hidden" name="_method" value="post">
                           <input type="hidden" name="_token" :value="csrf_token">
                            <button type="submit" class="button download-button">
                                <span class="icon">
                                    <i class="fa fa-copy"></i>
                                </span>
                                <span>
                                    {{ __('Copy Course') }}
                                </span>
                            </button>
                        </form>
                        

                         <a v-bind:href="'/trips/'+ trip.id + '/days'" class="button" style="float:left">
                            <span class="icon">
                                <i class="fa fa-cogs"></i>
                            </span>
                            <span>
                                {{ __('Manage Course') }}
                            </span> 
                        </a>
                        
                         <form method="post" :action="'/trips/' + trip.id + '/generate'" style="float:left">
                            <input type="hidden" name="_method" value="post">
                           <input type="hidden" name="_token" :value="csrf_token">
                            <button type="submit" class="button download-button">
                                <span class="icon">
                                    <i class="fa fa-download"></i>
                                </span>
                                <span>
                                    {{ __('Generate Package') }}
                                </span>
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <nav class="pagination" v-if="!tableShow.showdata">
                <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
                <a v-if="pagination.prevPageUrl" class="btn btn-sm btn-primary pagination-previous" @click="--pagination.currentPage">
                    Prev
                </a>
                <a class="btn btn-sm btn-primary pagination-previous" v-else disabled>
                Prev
                </a>
                <a v-if="pagination.nextPageUrl" class="btn btn-sm pagination-next" @click="++pagination.currentPage">
                    Next
                </a>
                <a class="btn btn-sm btn-primary pagination-next" v-else disabled>
                    Next
                </a>
            </nav>
            <nav class="pagination" v-else>
                <span class="page-stats">
                    {{pagination.from}} - {{pagination.to}} of {{filteredTrips.length}}
                    <span v-if="`filteredTrips.length < pagination.total`"></span>
                </span>
                <a v-if="pagination.prevPage" class="btn btn-sm btn-primary pagination-previous" @click="--pagination.currentPage">
                    Prev
                </a>
                <a class="btn btn-sm pagination-previous btn-primary" v-else disabled>
                Prev
                </a>
                <a v-if="pagination.nextPage" class="btn btn-sm btn-primary pagination-next" @click="++pagination.currentPage">
                    Next
                </a>
                <a class="btn btn-sm pagination-next btn-primary"  v-else disabled>
                    Next
                </a>
            </nav>
        </div>
       
    </div>
</template>

<script>

export default {
    created() {
        this.getTrips();
        Fire.$on('reloadTrips', () => {
            this.getTrips();
        })
    },

    data() {
        
        let columns = [
            {label: 'Course Name', name: 'name'},
            {label: 'Owner', name: 'owner'},
        ];
       
        
        return {
            trips: [],
            columns: columns,
            length: 10,
            search: '',
            tableShow: {
                showdata: true,
            },
            pagination: {
                currentPage: 1,
                total: '',
                nextPage: '',
                prevPage: '',
                from: '',
                to: ''
            },
            
        }
    },

    props: ['csrf_token'],

    methods: {
      
      
        
        getTrips() {
             axios.get('/alltrips').then(function(response){
                    this.trips = response.data;
                }.bind(this));
        },

       paginate(array, length, pageNumber) {
            this.pagination.from = array.length ? ((pageNumber - 1) * length) + 1 : ' ';
            this.pagination.to = pageNumber * length > array.length ? array.length : pageNumber * length;
            this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
            this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
            return array.slice((pageNumber - 1) * length, pageNumber * length);
        },
        resetPagination() {
            this.pagination.currentPage = 1;
            this.pagination.prevPage = '';
            this.pagination.nextPage = '';
        },
       
    },
    computed: {
        filteredTrips() {
            let trips = this.trips;
            if (this.search) {
                trips = trips.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }
       
            return trips;
        },
         paginatedTrips() {
            return this.paginate(this.filteredTrips, this.length, this.pagination.currentPage);
        }
       
    }
};
</script>