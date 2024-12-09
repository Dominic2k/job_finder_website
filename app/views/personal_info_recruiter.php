<div id="personal-info" class="profile-session" style="display: none;">
    <div class="header">
        <h1>Hồ sơ của tôi</h1>
    </div>
    <div class="basic_info">
        <h3>Thông tin cơ bản</h3>
        <p>Đây là thông tin cá nhân của bạn mà bạn có thể cập nhật bất kỳ lúc nào.</p>
    </div>
    <div class="form-section">
        <div class="avatar-container">
        <!-- Avatar Display -->
            <div class="avatar">
            <?php
                    foreach($userbyid as $key => $value) {
            ?>
                <img src="../public/img/<?php echo $value['avatar'] ?>" alt="Avatar" id="avatarImage">
            <?php
                    }
            ?>
            </div>

            <!-- Upload Box -->
            <label class="upload-box" for="avatarInput">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 2a10 10 0 1 1-10 10A10 10 0 0 1 12 2m0-2a12 12 0 1 0 12 12A12 12 0 0 0 12 0Zm2 13h-4v4H8v-4H4v-2h4V7h2v4h4Z"/>
                </svg>
                <span>Nhấn để thay thế<br>hoặc kéo và thả<br>SVG, PNG, JPG hoặc GIF (tối đa. 400 x 400px)</span>
                <input type="file" id="avatarInput" accept="image/*">
            </label>
        </div>
        <form action="<?php echo BASE_URL ?>recruiter/updatecompany" method="POST" class="form_basic_info card-content form_company_info" enctype="multipart/form-data">
            <?php
                    foreach($userbyid as $key => $value) {
            ?>
            <div class="form-group">
                <label for="name">Họ và tên *</label>
                <input type="text" id="name" name="name" placeholder="Họ và tên" value="<?php echo $value['full_name'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại *</label>
                <input type="text" id="phone" name="phone" placeholder="Số điện thoại" value="<?php echo $value['phone'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" placeholder="Địa chỉ email" value="<?php echo $value['email'] ?>" readonly>
            </div>
            <?php
                }
            ?>
    
        <!-- Company Information -->
            <div class="card company-info">
                <h3 class="card-header">Thông tin công ty</h3>
                <?php
                        foreach($userbyid as $key => $value) {
                ?>
                <input type="hidden" value="<?php echo $value['user_id'] ?>" name="user_id">
                <input type="hidden" value="<?php echo $value['comp_id'] ?>" name="comp_id">
                <div class="form-group">
                    <label class="company-title" for="company-name">Tên công ty *</label>
                    <input type="text" id="company-name" name="comp_name" placeholder="Tên công ty" value="<?php echo $value['comp_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="logo">Logo *</label>
                    <?php if (!empty($value['comp_logo'])): ?>
                        <div>
                            <p>Logo hiện tại:</p>
                            <img src="../public/img/<?php echo $value['comp_logo']; ?>" alt="Logo hiện tại" style="max-width: 60px; height: auto;">
                        </div>
                    <?php endif; ?>
                    <input type="file" id="logo" name="comp_logo" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="website">Website *</label>
                    <input type="text" id="website" name="comp_website" placeholder="Trang web" value="<?php echo $value['comp_website'] ?>">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ *</label>
                    <input type="text" id="address" name="comp_address" placeholder="Địa chỉ" value="<?php echo $value['comp_address'] ?>">
                </div>
                <div class="form-group">
                    <label for="employees">Số lượng nhân viên *</label>
                    <input type="number" id="employees" name="employee_count" placeholder="Số lượng nhân viên" value="<?php echo $value['employee_count'] ?>">
                </div>
                <div class="form-group">
                    <label for="description">Những lợi ích khi làm việc tại công ti *</label>
                    <textarea id="description" name="comp_benefit" placeholder="Lợi ích mang lại"><?php echo $value['comp_benefit'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="industry">Ngành nghề *</label>
                    <select name="industry_id" id="industry" class="form-control select-control">
                        <option value="1" <?php echo $value['industry_id'] == 1 ? 'selected' : ''; ?>>Software Development</option>
                        <option value="2" <?php echo $value['industry_id'] == 2 ? 'selected' : ''; ?>>Healthcare</option>
                        <option value="3" <?php echo $value['industry_id'] == 3 ? 'selected' : ''; ?>>Education</option>
                        <option value="4" <?php echo $value['industry_id'] == 4 ? 'selected' : ''; ?>>Finance</option>
                        <option value="5" <?php echo $value['industry_id'] == 5 ? 'selected' : ''; ?>>Retail</option>
                        <option value="6" <?php echo $value['industry_id'] == 6 ? 'selected' : ''; ?>>Construction</option>
                        <option value="7" <?php echo $value['industry_id'] == 7 ? 'selected' : ''; ?>>Transportation</option>
                        <option value="8" <?php echo $value['industry_id'] == 8 ? 'selected' : ''; ?>>Telecommunications</option>
                        <option value="9" <?php echo $value['industry_id'] == 9 ? 'selected' : ''; ?>>Entertainment</option>
                        <option value="10" <?php echo $value['industry_id'] == 10 ? 'selected' : ''; ?>>Energy</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="founded">Ngày thành lập *</label>
                    <input type="date" id="founded" name="founded_date" value="<?php echo $value['founded_date'] ?>">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả *</label>
                    <textarea id="description" name="comp_description" placeholder="Mô tả công ty"><?php echo $value['comp_description'] ?></textarea>
                </div>
                <?php
                    }
                ?>
                <button type="submit" class="btn-save">Lưu hồ sơ</button>
            </div>
        </form>
    </div>
</div>