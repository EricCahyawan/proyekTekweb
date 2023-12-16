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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            $no++;
        }
    }

    public function tampil_cooking($connect)
    {
        $ambilpost = $connect->query("SELECT * FROM user_post JOIN topic ON user_post.id_topic = topic.id_topic WHERE topic.nama_topic = 'Baking' order by id_post desc");
        $no = 1;

        while ($row = $ambilpost->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-2 col-12 mb-3">';
            echo '<a href="#" data-bs-toggle="modal" data-bs-target="#detailModal' . $no . '">';
            $fileExtension = pathinfo($row['data_images'], PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                echo '<div class="card">';
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
                echo '<img src="posts/' . $row['data_images'] . '" class="card-img-top card-img-bottom" width="100%" style="height: 150px; object-fit: cover">';
                echo '</div>';
            } elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
                echo '<div class="card">';
                echo '<video width="100%" height="150" controls class="card-img-top card-img-bottom"; object-fit: cover">';
                echo '<source src="posts/' . $row['data_images'] . '" type="video/' . $fileExtension . '">';
                echo '</video>';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<img src="posts/kosong.png" class="card-img-top" width="100%" style="height: 150px object-fit: cover">';
                echo '</div>';
            }

            echo '</a>';
            echo '</div>';

            echo '<div class="modal fade" id="detailModal' . $no . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-lg">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel"></h5>';
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
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
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
