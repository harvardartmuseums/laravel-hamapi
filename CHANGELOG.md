# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Complete package modernization for Laravel 10, 11, and 12 compatibility
- PHP 8.1+ support with strict types and modern syntax
- Comprehensive error handling with custom exceptions
- Type-safe DTOs for API responses
- Full PHPUnit test suite with 100% coverage target
- Laravel HTTP client integration replacing manual cURL requests
- Modern caching implementation using Laravel Cache
- Proper dependency injection and service container binding
- GitHub Actions CI/CD pipeline
- PHPStan level 8 static analysis
- Laravel Pint code formatting
- Comprehensive documentation

### Changed
- Minimum PHP version requirement to 8.1
- Service provider architecture to use contracts and interfaces
- Configuration structure for better organization
- Error handling to throw specific exceptions instead of returning false
- HTTP requests to use Laravel's HTTP client with retry logic

### Removed
- Legacy PHP 7.x support
- Manual cURL implementations
- Hardcoded configuration values
- Complex manual URL building logic

## [1.0.0] - Previous Release

- Initial package implementation
- Basic HAM API integration
- Laravel service provider
- Simple caching support