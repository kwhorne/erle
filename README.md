# Erle - CRM and intranet system 🚀

> **Modern multilingual CRM and intranet system built with Laravel 12, FluxUI v2 and Filament 4**

Erle is a comprehensive CRM and intranet system designed to help businesses manage projects, work orders, contacts, and documents efficiently. Built with **Laravel 12**, **FluxUI v2**, and **Filament 4**, it provides a modern, intuitive interface for project management workflows.

**🌍 Multilingual Support**: Native Norwegian and English localization with seamless language switching.

**🧹 Optimized Database**: Clean, consolidated migrations for better performance and maintainability.

## ✨ Features

### 📊 Project Management     
- **Project Tracking** - Complete project lifecycle management
- **Work Orders** - Create and manage work orders with priorities
- **Budget Management** - Track estimated vs actual costs and hours
- **Timeline Management** - Plan and monitor project deadlines
- **Progress Tracking** - Visual progress indicators and milestones

### 👥 Client & Contact Management
- **Contact Directory** - Manage client and team contact information
- **Client Communication** - Track client notes and communications
- **Team Assignment** - Assign project managers and team leads

### 📁 Document Management
- **File Organization** - Categorized document storage
- **Media Library** - Integrated file management system
- **Document Sharing** - Secure document access and sharing

### 📝 Communication & Reporting
- **Message System** - Internal communication tools
- **Blog/News System** - Company announcements and updates
- **Reporting** - Project status and performance reports

### 🎯 Feature Request Management
- **Feature Requests** - Submit, track, and manage feature requests
- **Voting System** - Users can vote on popular feature requests
- **Workflow Management** - Complete status tracking from submission to completion
- **Priority Management** - Categorize by priority (low, normal, high, critical)
- **Type Classification** - Feature, enhancement, bug fix, integration, performance, UI/UX
- **Assignment & Review** - Assign to team members and track reviews
- **Bulk Operations** - Approve, reject, or manage multiple requests efficiently
- **Business Justification** - Document business value and technical requirements
- **Implementation Tracking** - Monitor progress with target dates and version releases
- **Category Organization** - Organize by UI, backend, mobile, API, security, etc.

### 🌍 Multilingual Support
- **Norwegian & English** - Native support for Norwegian Bokmål and English
- **Real-time Language Switching** - Seamless language switching in admin panel
- **Localized Content** - All UI elements, forms, and messages fully translated
- **Filament Language Switch** - Official plugin integration for language management
- **User Preferences** - Individual language settings per user

### 🎨 Modern Tech Stack
- **Laravel 12** - Latest PHP framework
- **FluxUI v2** - Modern, Apple-inspired component library
- **Filament 4** - Beautiful admin panel
- **Tailwind CSS 4.0** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Livewire** - Dynamic frontend components

## 📸 Screenshots

### Admin Dashboard
![Admin Dashboard](docs/screenshots/dashboard.png)
*Clean, modern dashboard with project overview and quick actions*

### Language Switching
![Language Switch](docs/screenshots/language-switch.png)
*Seamless language switching between Norwegian and English*

### Project Management
![Project Management](docs/screenshots/projects.png)
*Comprehensive project tracking with timeline and budget management*

### Mobile Responsive
![Mobile View](docs/screenshots/mobile.png)
*Fully responsive design that works on all devices*

## 🚀 Quick Start

### Requirements
- PHP 8.3+
- Composer
- Node.js & npm
- MySQL 8.0+
- Laravel Herd (recommended for local development)

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/kwhorne/erle.git
cd erle
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
# Option 1: Use clean migrations (recommended)
./database/migrations_clean/migrate_clean.sh

# Option 2: Standard migration
php artisan migrate --seed
```

5. **Build assets**
```bash
npm run build
```

6. **Start development server**
```bash
# Using Laravel Herd (recommended)
# Herd should automatically detect the project
# Visit: http://erle.test

# Alternative: Using built-in server
php artisan serve
```

## 📁 Project Structure

```
erle/
├── app/
│   ├── Filament/           # Filament admin panel
│   │   └── Resources/      # Project, WorkOrder, Contact, FeatureRequest resources
│   ├── Models/             # Eloquent models
│   │   ├── Project.php     # Project management
│   │   ├── WorkOrder.php   # Work order tracking
│   │   ├── Contact.php     # Client/contact management
│   │   ├── Document.php    # Document management
│   │   ├── FeatureRequest.php # Feature request management
│   │   └── User.php        # User management
│   └── Http/               # Controllers, middleware
├── resources/
│   ├── views/              # Blade templates with FluxUI
│   ├── js/                 # Alpine.js components
│   └── css/                # Tailwind CSS
├── database/
│   ├── migrations/         # Database migrations
│   ├── migrations_clean/   # Clean, optimized migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── lang/               # Language files (nb, en)
│   │   ├── nb/             # Norwegian Bokmål translations
│   │   └── en/             # English translations
└── routes/                 # Application routes
```

## 🎯 Access Points

- **Public Site**: `http://erle.test` (with Herd) or `http://localhost:8000`
- **Admin Panel**: `http://erle.test/admin` (with Herd) or `http://localhost:8000/admin`

## 🔧 Configuration

### 🌍 Language Settings
Erle supports Norwegian Bokmål (nb) and English (en) with automatic language switching:

```bash
# Default language is set to Norwegian Bokmål
APP_LOCALE=nb
APP_FALLBACK_LOCALE=en
```

**Language Switching**:
- Users can switch language in the admin panel
- Language preference is saved per user
- All UI elements update immediately
- Translation files located in `resources/lang/nb/` and `resources/lang/en/`

### FluxUI Icons
Import Lucide icons using the built-in Artisan command:
```bash
php artisan flux:icon crown grip-vertical github
```

### Filament Admin Panel
The admin panel is configured in `app/Providers/Filament/AdminPanelProvider.php`:
- SPA Mode enabled for better performance
- Custom theme with FluxUI integration
- Authentication with Laravel Breeze
- Profile management included

### Development Commands
Erle includes convenient composer commands:
```bash
composer review  # Run all code quality tools
composer test    # Run Pest test suite
composer format  # Fix code style with Pint
```

## 🎨 Design System

### Color Palette
- **Background**: `#F9FAFB` (neutral-50)
- **Text**: `#1A1A1A` (gray-900)
- **Accent**: Deep indigo or forest green
- **Cards**: Rounded corners (2xl), subtle shadows

### Typography
- **Font**: Inter or SF Pro
- **Headers**: Bold, 24-32px
- **Body**: Medium weight, readable sizes
- **Spacing**: Generous padding (24-40px)

## 🛡️ Security Features

- **User Authentication** - Multi-level access control
- **Role-based Permissions** - Employee, admin, patient roles
- **Data Encryption** - Sensitive data protection
- **GDPR Compliance** - Privacy by design
- **Audit Logging** - Activity tracking

## 🧹 Database Optimization

Erle includes a clean migration system that consolidates fragmented migrations for better performance:

### Clean Migrations
```bash
# Use optimized migrations (recommended)
./database/migrations_clean/migrate_clean.sh

# This script will:
# - Backup current database
# - Replace fragmented migrations with clean versions
# - Reduce migration count from 22 to 9 files
# - Improve database performance with proper indexing
```

### Migration Comparison
- **Before**: 22 migrations with fragmented changes
- **After**: 9 clean, consolidated migrations
- **Benefits**: 59% reduction in migration files, better performance, easier maintenance

### Database Features
- **Optimized Indexing** - Strategic indexes on all tables
- **JSON Support** - Flexible data structures where needed
- **Foreign Key Relationships** - Proper relational integrity
- **Migration Rollback** - Safe database version management

## 🔄 Development Workflow

### Database Seeding
```bash
php artisan migrate:fresh --seed
```

### Asset Development
```bash
npm run dev    # Development mode
npm run build  # Production build
npm run watch  # Watch for changes
```

### Testing
```bash
php artisan test
```

## 🛣️ Roadmap

### 📊 Analytics & Reporting
- [ ] Project profitability analysis
- [ ] Time tracking reports
- [ ] Client satisfaction metrics
- [ ] Team performance dashboards

### 📱 Mobile App
- [ ] React Native mobile app
- [ ] Time tracking on mobile
- [ ] Push notifications
- [ ] Offline capability

### 🌐 Additional Languages
- [ ] Danish localization
- [ ] Swedish localization
- [ ] German localization
- [ ] Community translation contributions

### 🔌 Integrations
- [ ] Slack integration
- [ ] Microsoft Teams integration
- [ ] Calendar sync (Google/Outlook)
- [ ] Email automation

## 📚 Best Practices

### 🔒 Security
- Always use HTTPS in production
- Regularly update dependencies
- Implement rate limiting
- Use environment variables for sensitive data
- Enable two-factor authentication

### 🚀 Performance
- Use database indexing effectively
- Implement caching strategies
- Optimize images and assets
- Monitor database queries
- Use CDN for static assets

### 🌍 Localization
- Always use translation keys in code
- Test both language versions
- Consider cultural differences in design
- Provide fallback translations
- Use proper date/time formatting

## 📦 Key Dependencies

- **laravel/framework**: `^12.0`
- **filament/filament**: `^4.0`
- **bezhansalleh/filament-language-switch**: `^4.0.0-beta2` *(language switching)*
- **flux-ui/flux**: `^2.0` *(requires license)*
- **tailwindcss**: `^4.0`
- **alpinejs**: `^3.0`
- **livewire/livewire**: `^3.0`
- **spatie/laravel-medialibrary**: `^11.0` *(file management)*
- **spatie/laravel-tags**: `^4.0` *(tagging system)*

> **Note**: All resources including the new Feature Request system have full multilingual support (Norwegian/English) with seamless language switching.

## 🤝 Contributing

Contributions are welcome! Please read our contributing guidelines and submit pull requests to help improve Erle.

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

### 📝 FluxUI License Requirements

**Important:** FluxUI v2 requires a separate commercial license for most use cases:

- **Free for personal/open-source projects** - Limited to non-commercial use
- **Commercial license required** - For any commercial or client work
- **Pricing**: Starting at $199 for single developer
- **Purchase**: Visit [FluxUI.dev](https://fluxui.dev) for licensing options

**Alternative**: You can replace FluxUI components with:
- Tailwind UI components (also requires license)
- Headless UI (free)
- Custom Tailwind components
- Other free component libraries

> **Note**: The starter pack architecture works with any component library - FluxUI is just our recommendation for the best developer experience.

## 👨‍💻 About the Developer

Erle is developed by **Knut W. Horne** ([kwhorne.com](https://kwhorne.com)) - a passionate developer creating innovative digital solutions with focus on user experience and modern technologies.

## ❓ FAQ

### **Q: How do I change the default language?**
A: Edit your `.env` file and set `APP_LOCALE=en` for English or `APP_LOCALE=nb` for Norwegian. Users can also change their individual language preference in the admin panel.

### **Q: Can I add more languages?**
A: Yes! Create new language files in `resources/lang/` and update the language switcher configuration in `AppServiceProvider.php`.

### **Q: How do I backup my database?**
A: Use the built-in backup command: `php artisan db:backup` or use the migration cleanup script which includes automatic backup.

### **Q: What if I encounter migration issues?**
A: Use the clean migration system: `./database/migrations_clean/migrate_clean.sh`. This will backup your data and use optimized migrations.

### **Q: How do I add custom fields to projects?**
A: Use the `custom_fields` JSON column in the projects table, or create a migration to add specific columns.

### **Q: Can I customize the admin panel theme?**
A: Yes! The admin panel uses Filament 4 with FluxUI components. You can customize colors, fonts, and layouts in the panel configuration.

### **Q: How do I set up email notifications?**
A: Configure your mail settings in `.env` and use Laravel's notification system. Message and project notifications are built-in.

### **Q: Is there an API available?**
A: Not yet, but it's on the roadmap. The current system focuses on web-based management.

### **Q: How do I use the Feature Request system?**
A: Navigate to `/app/feature-requests` in the admin panel. You can submit new requests, vote on existing ones, and track their progress through the complete workflow from submission to completion.

### **Q: Can I customize Feature Request categories?**
A: Yes! The categories are defined in the translation files (`resources/lang/nb/feature_requests.php` and `resources/lang/en/feature_requests.php`). You can add, remove, or modify categories as needed.

## 🚑 Troubleshooting

### **Migration Issues**
```bash
# If you encounter migration conflicts
php artisan migrate:status
php artisan migrate:rollback

# Use clean migrations instead
./database/migrations_clean/migrate_clean.sh
```

### **Language Switching Not Working**
```bash
# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Verify language files exist
ls resources/lang/nb/
ls resources/lang/en/
```

### **FluxUI Components Not Loading**
```bash
# Verify FluxUI is installed
composer show flux-ui/flux

# Check if license is configured
# Visit https://fluxui.dev for licensing
```

### **Performance Issues**
```bash
# Optimize application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check database indexes
php artisan db:show --counts
```

### **File Upload Issues**
```bash
# Check storage permissions
php artisan storage:link
chmod -R 755 storage/

# Verify file size limits in php.ini
upload_max_filesize = 10M
post_max_size = 10M
```

---

**Ready to build something amazing?** 🚀

Start managing your projects efficiently with Erle and experience the power of modern project management tools.

## 🔄 Default Credentials

For development purposes, a default admin user is created with the following credentials:

**Admin User:**
- Email: `admin@example.com`
- Password: `password`
- **Default Language**: Norwegian Bokmål (nb)

> **Security Note:** Remember to change the default password before deploying to production.

**Language Preference:**
- Users can change their language preference in the admin panel
- Language setting is saved per user and persists across sessions
- Supports Norwegian Bokmål (nb) and English (en)

**Feature Request Access:**
- Navigate to `/app/feature-requests` in the admin panel
- Submit new feature requests with detailed business justification
- Vote on existing feature requests to show support
- Track implementation progress and status updates
- Organized under the "Team" navigation group

## 🚀 Production Deployment

Before deploying to production:

1. **Environment Configuration**
   - Set `APP_ENV=production`
   - Configure secure database credentials
   - Set up proper mail configuration
   - Configure backup and monitoring

2. **Security Checklist**
   - Change default passwords
   - Enable HTTPS/SSL
   - Configure proper file permissions
   - Set up rate limiting
   - Review user access controls

3. **Performance Optimization**
   - Enable caching (`php artisan config:cache`)
   - Optimize autoloader (`composer install --optimize-autoloader`)
   - Configure queue workers for background jobs
   - Set up CDN for static assets

## 🔧 Customization

### Adding New Filament Resources
```bash
php artisan make:filament-resource ModelName --generate
```

### Creating Custom Widgets
```bash
php artisan make:filament-widget WidgetName
```

### FluxUI Components
Erle is built to work with FluxUI v2 components. **Note:** FluxUI requires a separate license for commercial use. Check the [FluxUI documentation](https://fluxui.dev/docs) for usage examples and licensing information.

### Artisan Commands
The project includes essential Artisan commands:
- `php artisan flux:icon` - Import Lucide icons
- `php artisan make:filament-user` - Create admin users
- `php artisan migrate:fresh --seed` - Reset database with sample data

## 🌟 What's Included

✅ **Laravel 12 Foundation**  
✅ **Filament 4 Admin Panel**  
✅ **FluxUI v2 Ready** *(requires license)*  
✅ **Tailwind CSS 4.0**  
✅ **Alpine.js Integration**  
✅ **Laravel Breeze Authentication**  
✅ **Lucide Icons Support**  
✅ **Vite Asset Pipeline**  
✅ **Database Migrations**  
✅ **User Seeding**  
✅ **Code Quality Tools**  
✅ **Pest Testing Framework**  
✅ **Modern UI Components**  
✅ **Production-Ready Config**  

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [Laravel documentation](https://laravel.com/docs)
2. Review [Filament documentation](https://filamentphp.com/docs)
3. Consult [FluxUI documentation](https://fluxui.dev/docs)
4. Open an issue on GitHub

## 🎯 Next Steps

After installation, you can:

1. **Explore the Admin Panel** - Navigate to `/admin` to see Filament in action
2. **Customize the Design** - Modify colors, fonts, and spacing to match your brand
3. **Add Your Models** - Create Eloquent models and Filament resources
4. **Build Your Frontend** - Use FluxUI components in your Blade templates
5. **Deploy to Production** - Follow the deployment checklist above

## 💡 Tips for Success

- **Start with Models** - Define your data structure first
- **Use Filament Resources** - Leverage the admin panel for quick CRUD operations
- **Embrace FluxUI** - Use the beautiful components for consistent design
- **Follow TALL Stack** - Keep your architecture clean and maintainable
- **Write Tests** - Use the included Pest framework for quality assurance

---

**Built with ❤️ by Knut W. Horne** - *Innovative digital solutions for modern project management*

