   // JS để chỉnh sửa AVT nhà tuyển dụng

   const avatarInput = document.getElementById('avatarInput');
   const avatarImage = document.getElementById('avatarImage');
   avatarInput.addEventListener('change', (event) => {
       const file = event.target.files[0];
       if (file) {
       const reader = new FileReader();
       reader.onload = (e) => {
           avatarImage.src = e.target.result;
       };
       reader.readAsDataURL(file);  
       }
   });
   
   // -----------------------JS để chỉnh sửa AVT nhà tuyển dụng-----------------------------
   
   
   // JS ẩn hiện các phần khi nhấn vào menu
   document.getElementById("home-button").addEventListener("click", function () {
       document.getElementById("dashboard").style.display = "block";
       document.getElementById("personal-info").style.display = "none";
       document.getElementById("job-list").style.display = "none";
    //    document.getElementById('applicant-list').style.display = 'none';
    //    document.getElementById('applicant-detail').style.display = 'none';
       document.getElementById('create-job-form1').style.display = 'none';
       document.getElementById('create-job-form2').style.display = 'none';
       document.getElementById('create-job-form3').style.display = 'none';
   });
   document.getElementById("profile-button").addEventListener("click", function () {
       document.getElementById("dashboard").style.display = "none";
       document.getElementById("personal-info").style.display = "block";
       document.getElementById("job-list").style.display = "none";
    //    document.getElementById('applicant-list').style.display = 'none';
    //    document.getElementById('applicant-detail').style.display = 'none';
       document.getElementById('create-job-form1').style.display = 'none';
       document.getElementById('create-job-form2').style.display = 'none';
       document.getElementById('create-job-form3').style.display = 'none';
   
   });
   document.getElementById("job-list-button").addEventListener("click", function () {
       document.getElementById("dashboard").style.display = "none";
       document.getElementById("personal-info").style.display = "none";
       document.getElementById("job-list").style.display = "block";
    //    document.getElementById('applicant-list').style.display = 'none';
    //    document.getElementById('applicant-detail').style.display = 'none';
       document.getElementById('create-job-form1').style.display = 'none';
       document.getElementById('create-job-form2').style.display = 'none';
       document.getElementById('create-job-form3').style.display = 'none';
   
   });
   
   // --------------------------JS ẩn hiện các phần khi nhấn vào menu---------------------------
   
   // JS Dashboard tạo biểu đồ
   document.addEventListener("DOMContentLoaded", function () {
       let total_jobs =  document.getElementById('total_jobs').textContent;
       let total_rejected = document.getElementById('total_rejected').textContent;
       let total_accepted = document.getElementById('total_accepted').textContent;
       let total_pending = document.getElementById('total_pending').textContent;
     function createPerformanceData() {
         return {
             labels: ['Tổng số công việc', 'Từ chối', 'Chờ xử lí', 'Chấp nhận'],
             datasets: [{
                 label: 'Job Performance',
                 data: [total_jobs, total_rejected, total_accepted, total_pending],
                 backgroundColor: [
                     'rgba(75, 192, 192, 0.2)',
                     'rgba(255, 99, 132, 0.2)',
                     'rgba(255, 206, 86, 0.2)',
                     'rgba(54, 162, 235, 0.2)'
                 ],
                 borderColor: [
                     'rgba(75, 192, 192, 1)',
                     'rgba(255, 99, 132, 1)',
                     'rgba(255, 206, 86, 1)',
                     'rgba(54, 162, 235, 1)'
                 ],
                 borderWidth: 1
             }]
         };
     }
     function initializeChart(chartId, data) {
         const ctx = document.getElementById(chartId).getContext('2d');
         new Chart(ctx, {
             type: 'bar',
             data: data,
             options: {
                 responsive: true,
                 plugins: {
                     legend: {
                         display: true,
                         position: 'top'
                     }
                 },
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 }
             }
         });
     }
     const performanceData = createPerformanceData();
     initializeChart('jobPerformanceChart', performanceData);
   });
   
   
   // JS để thêm class active khi nhấn vào menu
   const menuItems = document.querySelectorAll('.sidebar .menu ul li a');
   menuItems.forEach(item => {
       item.addEventListener('click', () => {
           menuItems.forEach(i => i.parentElement.classList.remove('active'));
           item.parentElement.classList.add('active');
       });
   });
    
   
   document.addEventListener("DOMContentLoaded", () => {
       const addNewJobBtns = document.querySelector("#add-new-job-btn");
       const viewBtns = document.querySelectorAll(".btn-view");
       const jobList = document.getElementById("job-list");
       const applicantList = document.getElementById('applicant-list');
       const applicantDetail = document.getElementById("applicant-detail");
       const createJobForm1 = document.getElementById("create-job-form1");
       const createJobForm2 = document.getElementById("create-job-form2");
       const createJobForm3 = document.getElementById("create-job-form3");
       const nextFirstFormBtn = document.querySelector("#next-btn1");
       const nextSecondFormBtn = document.querySelector("#next-btn2");

        // Nút xem đơn ứng tuyển
       viewBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            applicantList.style.display = "none";
            applicantDetail.style.display = "block";
          });
      });
      //  Nút tạo job mới
       addNewJobBtns.addEventListener("click", () => {
               createJobForm1.style.display = "block";
               jobList.style.display = "none";
               applicantList.style.display = "none";
               applicantDetail.style.display = "none";
           });
      //  Nút tiếp theo đầu tiên
       nextFirstFormBtn.addEventListener("click", () => {
         createJobForm1.style.display = "none";
         createJobForm2.style.display = "block";
        });
        // Nút tiếp theo thứ 2
        nextSecondFormBtn.addEventListener("click", () => {
          createJobForm2.style.display = "none";
          createJobForm3.style.display = "block";
        });
        

   });
   
