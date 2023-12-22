<?php
class PostPulse
{
    private $db;

    public function __construct($db = '')
    {
        $this->setConnect($db);
    }

    public function setConnect($db)
    {
        $this->db = $db;
    }

    public function insert_post($data)
    {
        $insert_post = "INSERT INTO user_post (id_topic, data_images) 
                            VALUES (:id_topic, :foto)";
        $stmt = $this->db->prepare($insert_post);
        $stmt->bindParam(':id_topic', $data['id_topic']);
        $stmt->bindParam(':foto', $data['foto']);
        $stmt->execute();
        return true;
    }

    public function insert_komentar($data)
    {
        $insert_komentar = "INSERT INTO komentar (id_post, username, komentar) 
                            VALUES (:id_post, :username, :komentar)";
        $stmt = $this->db->prepare($insert_komentar);
        $stmt->bindParam(':id_post', $data['id_post']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':komentar', $data['komentar']);
        $stmt->execute();
        return true;
    }

    public function insert_komentarbalasan($data)
    {
        $insert_komentarbalasan = "INSERT INTO komentarbalasan (idkomentar, username, komentar) 
                            VALUES (:idkomentar, :username, :komentar)";
        $stmt = $this->db->prepare($insert_komentarbalasan);
        $stmt->bindParam(':idkomentar', $data['idkomentar']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':komentar', $data['komentar']);
        $stmt->execute();
        return true;
    }

    public function tampil_post($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">';
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">';
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_baking($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Baking' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">'; 
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_sport($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Sport' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">'; 
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_makeup($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Make Up' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">'; 
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_kpop($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'K-Pop' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">'; 
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_hairstyle($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Hairstyle' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">'; 
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_drawing($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Drawing' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">';
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_cooking($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Cooking' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">'; 
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_games($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Games' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">'; 
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }
    
    public function tampil_car($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Car' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">' . $row['nama_topic'] . '</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top" width="100%">';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<video width="100%" controls>';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
            } else {
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%">';
            }
            echo '<div class="col-md-12 col-12 mt-3">';
            echo '<form method="post" enctype="multipart/form-data">'; 
            echo '<div class="mb-3">';
            echo '<label for="username" class="form-label">Username</label>';
            echo '<input type="text" class="form-control" id="username" name="username" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="komentar" class="form-label">Komentar</label>';
            echo '<textarea rows="5" class="form-control" id="komentar" name="komentar" required></textarea>';
            echo '</div>';
            echo '<input type="hidden" name="id_post" value="' . $row['id_post'] . '">'; 
            echo '<button type="submit" name="simpankomentar" value="simpankomentar" class="btn btn-primary float-right">Kirim Komentar</button>';
            echo '</form>';
            $idpost = $row['id_post'];
            $ambilkomentar = $connect->query("SELECT * FROM komentar WHERE id_post = '$idpost' ORDER BY idkomentar asc");
            while ($komentar = $ambilkomentar->fetch(PDO::FETCH_ASSOC)) {
                $idkomentar = $komentar['idkomentar'];
                echo '
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <div class="card-body">
                                    <b style="font-size:9pt">' . $komentar['username'] . '</b>
                                    <p class="date">' . $komentar['komentar'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-2">
                        </div>
                        <div class="col-md-10 col-10">';
                $ambilbalasan = $connect->query("SELECT * FROM komentarbalasan WHERE idkomentar = '$idkomentar' ORDER BY idkomentarbalasan asc");
                while ($balasan = $ambilbalasan->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b style="font-size:9pt">' . $balasan['username'] . '</b>
                                            <p class="date">' . $balasan['komentar'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                echo '<div class="card">
                                <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="balasan" class="form-label">Balasan</label>
                                        <input type="text" class="form-control" id="komentar" name="komentar" required>
                                        <input type="hidden" name="idkomentar" value="' . $idkomentar . '">
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" name="simpankomentarbalasan" value="simpankomentarbalasan" class="btn btn-primary float-end" style="margin-top:45px">Reply</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
            }


            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $no++;
        }
    }

    public function tampil_topic($connect)
    {
        $ambiltopic = $connect->query("SELECT * FROM topic");
        while ($row = $ambiltopic->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id_topic'] . '">' . $row['nama_topic'] . '</option>';
        }
    }
}
