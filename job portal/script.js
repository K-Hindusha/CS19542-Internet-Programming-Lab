const jobData = [
    { title: 'Software Engineer', company: 'TCS', location: 'Bangalore', description: 'Develop software applications.' },
    { title: 'Web Developer', company: 'Infosys', location: 'Remote', description: 'Create and maintain websites.' },
    { title: 'Data Analyst', company: 'Wipro', location: 'Mumbai', description: 'Analyze data to provide insights.' },
    { title: 'Project Manager', company: 'HCL Technologies', location: 'Delhi', description: 'Lead project teams to success.' },
    { title: 'Graphic Designer', company: 'Cognizant', location: 'Chennai', description: 'Design graphics for various media.' },
    { title: 'DevOps Engineer', company: 'Accenture', location: 'Hyderabad', description: 'Manage infrastructure and deployments.' },
    { title: 'Digital Marketing Specialist', company: 'Flipkart', location: 'Remote', description: 'Create digital marketing campaigns.' },
];

function displayJobs(jobs) {
    const jobList = document.getElementById('jobList');
    jobList.innerHTML = ''; // Clear existing listings
    jobs.forEach(job => {
        const li = document.createElement('li');
        li.innerHTML = `<h3>${job.title}</h3>
                        <p><strong>Company:</strong> ${job.company}</p>
                        <p><strong>Location:</strong> ${job.location}</p>
                        <p>${job.description}</p>`;
        jobList.appendChild(li);
    });
}

function searchJobs() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const locationFilter = document.getElementById('locationFilter').value;
    
    const filteredJobs = jobData.filter(job => {
        const matchesTitle = job.title.toLowerCase().includes(searchTerm);
        const matchesLocation = locationFilter ? job.location === locationFilter : true;
        return matchesTitle && matchesLocation;
    });
    
    displayJobs(filteredJobs);
}

function filterJobs() {
    searchJobs();
}

// Initially display all jobs
displayJobs(jobData);
