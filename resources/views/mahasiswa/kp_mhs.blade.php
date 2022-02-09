@extends('../layout_mhs.mhs')

@section('title-mhs')
Pengajuan KP
@endsection
@section('content')
        

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">PENGAJUAN KP</h1>

                    <div class="row">

                        <div class="col-lg-6">
                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tambah Pengajuan KP</h6>
                                </div>
                                <div class="card-body">
                                    <form action="/mhs/tambah/kp" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col">
                                    @foreach ($dajaran as $da)
                                            <div class="mb-3">
                                            <label>Semester</label>
                                            <input type="text" class="form-control" name="semester" id="semester" placeholder="Masukan Tahun" value="{{ $da->semester }}" readonly>
                                            </div>
                                </div>
                                       

                                        <div class="col">
                                            <div class="mb-3">
                                            <label>Tahun</label>
                                            <input type="text" class="form-control" name="tahun" placeholder="Masukan Tahun" value="{{ $da->tahun }}" readonly>
                                            </div>
                                        </div>
                                        @endforeach

                                        

                                        <div class="col">
                                            <div class="mb-3">
                                            <label>Nim</label>
                                            <input type="text" class="form-control" name="nim" placeholder="Masukan Nim" required="required" value="{{ Auth::user()->nim }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Nik</label>
                                        <input type="text" class="form-control" name="nik" placeholder="Masukan Nik" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Judul KP</label>
                                        <input type="text" class="form-control" name="judul" placeholder="Masukan Judul Kp" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Tools</label>
                                        <input type="text" class="form-control" name="tools" placeholder="Masukan Tools" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Spesifikasi</label>
                                        <input type="text" class="form-control" name="spesifikasi" placeholder="Masukan Spesifikasi" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Penguji</label>
                                        <input type="text" class="form-control" name="penguji" placeholder="Masukan penguji" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Ruang</label>
                                        <input type="text" class="form-control" name="ruang" placeholder="Masukan Ruang" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Lembaga</label>
                                        <input type="text" class="form-control" name="lembaga" placeholder="Masukan Lembaga" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Pimpinan</label>
                                        <input type="text" class="form-control" name="pimpinan" placeholder="Masukan Pimpinan" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>No Telepon</label>
                                        <input type="text" class="form-control" name="no_telp" placeholder="Masukan Telepon" required="required">
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat" placeholder="Masukan Alamat" required="required"></textarea>
                                        </div>
                                        </div>

                                        <div class="col">
                                        <div class="mb-3">
                                        <label>Dokumen</label> </br>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="dokumen">
                                            <label class="custom-file-label" for="customFile">Pilih file</label>
                                        </div>
                                        </div>
                                        
                                         <div class="card-body">
                                            <input type="submit" class="btn btn-success btn-block" value="Tambah">  
                                        </div>
                                </div>
                                </div>
                                
                            </div>
                                    </form>
                                    

                                        

                                     
                                        
                                
                        </div>

                         <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan Pra KP  </h6>
                                </div>

                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <!-- <th scope="col">ID  </th> -->
                                      <th scope="col">No</th>
                                      <th scope="col">Lembaga</th>
                                      
                                      <th scope="col">Status</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                   @foreach($datapra as $dpra)
                                      <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$dpra->lembaga}}</td>
                                        
                                        <td>
                                            @if($dpra->status == 3)
                                            <a href="#" class="btn btn-sm btn-warning">Belum diverifikasi</a>
                                            @elseif($dpra->status == 1)
                                            <a href="#" class="btn btn-sm btn-success">Setuju</a>
                                            @else
                                            <a href="#" class="btn btn-sm btn-danger">Ditolak</a>
                                            @endif
                                        </td>
                                      </tr>
                                    @endforeach
                                   

                                       
                                  </tbody>
                                </table>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan  KP  </h6>
                                </div>

                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <!-- <th scope="col">ID  </th> -->
                                      <th scope="col">No</th>
                                      <th scope="col">Judul</th>
                                      <th scope="col">Pembimbing</th>
                                      
                                      <th scope="col">Status</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($data as $dkp)
                                      <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$dkp->judul}}</td>
                                        <td>{{$dkp->penguji}}</td>
                                        
                                        <td>@if($dkp->status == 3)
                                            <a href="#" class="btn btn-sm btn-warning">Belum diverifikasi</a>
                                            @elseif($dkp->status == 1)
                                            <a href="#" class="btn btn-sm btn-success">Setuju</a>
                                            @else
                                            <a href="#" class="btn btn-sm btn-danger">Ditolak</a>
                                            @endif</td>
                                      </tr>
                                    @endforeach
                                   

                                       
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            

@endsection
