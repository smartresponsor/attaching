# Changelog

All notable changes to this repository will be documented in this file.

The format is based on Keep a Changelog and this component follows a pre-release-first discipline until its first stable tag.

## [Unreleased]

### Fixed
- Canonicalized attachment lifecycle persistence on Objecting state fields and removed duplicate status mapping
- Aligned identifier-migration rebuild SQL with current Objecting physical column names
- Pin the production Objecting contract to `dev-master` so deployment cannot resolve obsolete embedded-field metadata
- Synchronize operational documentation with canonical maintenance-command and storage implementation paths

### Security
- Refresh Symfony dependency locks to patched releases resolving current Composer audit advisories
- Reject absolute, traversal, dot-segment, empty-segment, and NUL-containing local attachment storage paths at the storage boundary

### Added
- Antora-compatible producer documentation surface
- GitHub Actions CI workflow for PHP 8.4 quality gates
- Initial release-process and documentation discoverability surface

## [0.1.0-pre]

### Added
- Initial Symfony-oriented attaching component baseline
- Doctrine ORM persistence baseline
- Local quality gates for PHPStan, PHPUnit, and PHP CS Fixer
