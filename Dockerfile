# Use an official PHP runtime as a base image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your PHP application files to the container's working directory
COPY . /var/www/html

# Expose port 80 (default HTTP port)
EXPOSE 80