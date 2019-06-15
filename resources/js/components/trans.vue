<template>
    <div class="row padd">
        <div class="col col-md-8">
            <div class="panel panel-default">                
                <div class="panel-body">
                    <h5>Tambahkan Barang Pemesanan</h5> <br>
                    <form >                        
                        <div class="col col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="Barang" class="form-control" v-model="queryString" v-on:keyup="autoBarang()">
                            </div>
                        </div>
                        <div class="col col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="Jumlah Item" class="form-control" v-model="barang.jumlah">
                            </div>
                        </div>
                        <div class="col col-md-3">
                            <button class="btn btn-primary"> <i class="fa fa-plus"></i> Tambahkan</button>
                        </div>
                    </form>
                    <br>                    
                    <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>                           
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>    
        <div class="col col-md-4">            
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5><b>Rincian Transaksi</b></h5>
                    <hr>
                    <div class="panel panel-body">
                        Total Barang: Rp. <br>
                    </div>
                    <div class="panel panel-body">                        
                        Total Diskon: Rp. <input type="number" class="form-control"> <br>
                    </div>
                    <div class="panel panel-body">
                    Total Biaya:  Rp. <br>
                    </div>
                    <button class="btn btn-danger btn-block ">Checkout</button>
                </div>
            </div>    
        </div>
    </div>    
</template>

<script>
export default {
    data(){
        return{
            queryString:'',
            barangs:[],
            barang:{
                kode:'',
                barang:'',
                harga:'',
                jumlah:'',
                diskon:'',                
                stok:'',
                warna:'',                
            }
        }
    },
    created() {
        this.viewTrans();
    },

    methods:{
        viewTrans(){
           fetch('api/barangs')
           .then(res=>res.json())
           .then(res=>{
               this.barangs=res.data
           })
           .catch(err=>console.log(err));
        },
        addBarang(){

        },
        delBarang(){

        },
        autoBarang(){

        }
    }
}
</script>
