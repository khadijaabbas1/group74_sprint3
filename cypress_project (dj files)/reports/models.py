from django.db import models

class Report(models.Model):
    ISSUE_CHOICES = [
        ('pothole', 'Pothole'),
        ('streetlight', 'Broken Streetlight'),
        ('garbage', 'Overflowing Garbage'),
        ('sidewalk', 'Damaged Sidewalk'),
        ('other', 'Other'),
    ]

    issue_type = models.CharField(max_length=50, choices=ISSUE_CHOICES)
    description = models.TextField()
    location = models.CharField(max_length=255)
    photo = models.ImageField(upload_to='report_photos/', blank=True, null=True)
    submitted_at = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return f"{self.issue_type} at {self.location}"
