        <!DOCTYPE html>
        <html>

        <head>
            <title>Input Array</title>
            <style>
                .container {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    margin-top: 50px;
                }

                .input-group {
                    margin-bottom: 20px;
                }

                .input-group label {
                    font-weight: bold;
                    margin-right: 10px;
                }

                .input-group input {
                    padding: 5px;
                    width: 200px;
                }

                #submit-btn {
                    padding: 10px 20px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    cursor: pointer;
                }

                #submit-btn:hover {
                    background-color: #45a049;
                }
            </style>
        </head>

        <?php
        $query = $this->db->query("SELECT * FROM `testing`")->result_array();
        ?>

        <body>
            <form action="<?= base_url(); ?>index.php/Aku/edit" method="POST">
                <div class="container">
                    <div class="container">
                        <?php foreach ($query as $key) {
                        ?>
                            <div class="input-group">
                                <label for="array1">Nama <?= $key['id']; ?>:</label>
                                <input type="hidden" id="id<?= $key['id']; ?>" name="id<?= $key['id']; ?>" value="<?= $key['id']; ?>">
                                <input type="text" id="name<?= $key['id']; ?>" name="name<?= $key['id']; ?>" value="<?= $key['nama']; ?>">
                            </div>
                        <?php
                        } ?>

                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </body>

        </html>