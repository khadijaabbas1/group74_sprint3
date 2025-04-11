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
    latitude = models.FloatField(null=True, blank=True)
    longitude = models.FloatField(null=True, blank=True)
    photo = models.ImageField(upload_to='uploads/', null=True, blank=True)
    subscribed = models.BooleanField(default=False)
    contact = models.CharField(max_length=100, null=True, blank=True)
    is_duplicate = models.BooleanField(default=False)
    flagged_for_review = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return f"{self.issue_type} at {self.location}"
